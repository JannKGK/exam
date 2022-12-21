function filterSignees() {
  var examTime = document.getElementById("examtime").value;

  var signeeRows = document.getElementsByClassName("signee-row");

  //if filter is set to all, show all times
  if(examTime == "all"){
    for (var i = 0; i < signeeRows.length; i++) {
      signeeRows[i].style.display = "";
    }
  } else {
    for (var i = 0; i < signeeRows.length; i++) {
      // Get the exam time cell of the current signee row
      var examTimeCell = signeeRows[i].getElementsByClassName("exam-time-cell")[0];
      // show the row iff the exam date of the row matches the filter
      if (examTimeCell.innerHTML == examTime) {
        signeeRows[i].style.display = "";
      }else {
        signeeRows[i].style.display = "none";
      }
    }
  }
}