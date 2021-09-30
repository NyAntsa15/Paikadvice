var picker = {
    attach : function (opt) {
      var dp = document.createElement("div");
      dp.dataset.target = opt.target;
      dp.dataset.startmon = opt.startmon ? "1" : "0";
      dp.classList.add("picker");
      if (opt.disableday) {
        dp.dataset.disableday = JSON.stringify(opt.disableday);
      }
      var today = new Date(),
          thisMonth = today.getUTCMonth(), 
          thisYear = today.getUTCFullYear(),
          months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

      var select = document.createElement("select"),
          option = null;
      select.classList.add("picker-m");
      for (var mth in months) {
        option = document.createElement("option");
        option.value = parseInt(mth) + 1;
        option.text = months[mth];
        select.appendChild(option);
      }
      select.selectedIndex = thisMonth;
      select.addEventListener("change", function(){ picker.draw(this); });
      dp.appendChild(select);

      var yRange = 10;
      select = document.createElement("select");
      select.classList.add("picker-y");
      for (var y = thisYear-yRange; y < thisYear+yRange; y++) {
        option = document.createElement("option");
        option.value = y;
        option.text = y;
        select.appendChild(option);
      }
      select.selectedIndex = yRange;
      select.addEventListener("change", function(){ picker.draw(this); });
      dp.appendChild(select);

      var days = document.createElement("div");
      days.classList.add("picker-d");
      dp.appendChild(days);
  
      picker.draw(select);
  
      if (opt.container) { document.getElementById(opt.container).appendChild(dp); }
        else {
        var uniqueID = 0;
        while (document.getElementById("picker-" + uniqueID) != null) {
          uniqueID = Math.floor(Math.random() * (100 - 2)) + 1;
        }
        dp.dataset.popup = "1";
        dp.dataset.dpid = uniqueID;

        var wrapper = document.createElement("div");
        wrapper.id = "picker-" + uniqueID;
        wrapper.classList.add("picker-wrap");
        wrapper.appendChild(dp);
  
        var target = document.getElementById(opt.target);
        target.dataset.dp = uniqueID;
        target.readOnly = true; 
        target.onfocus = function () {
          document.getElementById("picker-" + this.dataset.dp).classList.add("show");
        };
        wrapper.addEventListener("click", function (evt) {
          if (evt.target.classList.contains("picker-wrap")) {
            this.classList.remove("show");
          }
        });

        document.body.appendChild(wrapper);
      }
    },
  
    draw : function (el) {
      var parent = el.parentElement,
          year = parent.getElementsByClassName("picker-y")[0].value,
          month = parent.getElementsByClassName("picker-m")[0].value,
          days = parent.getElementsByClassName("picker-d")[0];
  
      var daysInMonth = new Date(Date.UTC(year, month, 0)).getUTCDate(),
          startDay = new Date(Date.UTC(year, month-1, 1)).getUTCDay(), // Note: Sun = 0
          endDay = new Date(Date.UTC(year, month-1, daysInMonth)).getUTCDay(),
          startDay = startDay==0 ? 7 : startDay,
          endDay = endDay==0 ? 7 : endDay;
  
      var squares = [],
          disableday = null;
      if (parent.dataset.disableday) {
        disableday = JSON.parse(parent.dataset.disableday);
      }
  
      if (parent.dataset.startmon=="1" && startDay!=1) {
        for (var i=1; i<startDay; i++) { squares.push("B"); }
      }
      if (parent.dataset.startmon=="0" && startDay!=7) {
        for (var i=0; i<startDay; i++) { squares.push("B"); }
      }
  
      if (disableday==null) {
        for (var i=1; i<=daysInMonth; i++) { squares.push([i, false]);  }
      }
  
      else {
        var thisday = startDay;
        for (var i=1; i<=daysInMonth; i++) {
          var disabled = disableday.includes(thisday);
          squares.push([i, disabled]);
          thisday++;
          if (thisday==8) { thisday = 1; }
        }
      }
  
      if (parent.dataset.startmon=="1" && endDay!=7) {
        for (var i=endDay; i<7; i++) { squares.push("B"); }
      }
      if (parent.dataset.startmon=="0" && endDay!=6) {
        for (var i=endDay; i<(endDay==7?13:6); i++) { squares.push("B"); }
      }
  
      var daynames = ["Mon", "Tue", "Wed", "Thur", "Fri", "Sat"];
      if (parent.dataset.startmon=="1") { daynames.push("Sun"); }
      else { daynames.unshift("Sun"); }
  
      var table = document.createElement("table"),
          row = table.insertRow(),
          cell = null;
      row.classList.add("picker-d-h");
      for (let d of daynames) {
        cell = row.insertCell();
        cell.innerHTML = d;
      }
  
      var total = squares.length,
          row = table.insertRow(),
          today = new Date(),
          todayDate = null;
      if (today.getUTCMonth()+1 == month && today.getUTCFullYear() == year) {
        todayDate = today.getUTCDate();
      }
      for (var i=0; i<total; i++) {
        if (i!=total && i%7==0) { row = table.insertRow(); }
        cell = row.insertCell();
        if (squares[i] == "B") {
          cell.classList.add("picker-d-b");
        } else {
          cell.innerHTML = squares[i][0];
          if (squares[i][1]) {
            cell.classList.add("picker-d-dd");
          }
          else {
            if (i == todayDate) { cell.classList.add("picker-d-td"); }
            cell.classList.add("picker-d-d");
            cell.addEventListener("click", function(){ picker.pick(this); });
          }
        }
      }
  
      days.innerHTML = "";
      days.appendChild(table);
    },
  
    pick : function (el) {
      var parent = el.parentElement;
      while (!parent.classList.contains("picker")) {
        parent = parent.parentElement;
      }
  
      var year = parent.getElementsByClassName("picker-y")[0].value,
          month = parent.getElementsByClassName("picker-m")[0].value,
          day = el.innerHTML;
  
      if (parseInt(month)<10) { month = "0" + month; }
      if (parseInt(day)<10) { day = "0" + day; }
      var fullDate = year + "-" + month + "-" + day;
  
      document.getElementById(parent.dataset.target).value = fullDate;
  
      if (parent.dataset.popup == "1") {
        document.getElementById("picker-" + parent.dataset.dpid).classList.remove("show");
      }
    }
};