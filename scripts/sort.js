function sortTableByDate(n, table_id){
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(table_id);
    switching = true;
    dir = "asc";

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length-1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i+1].getElementsByTagName("td")[n];

            //convert date strings to date variables to sort them better
            var xDate = new Date(x.innerHTML);
            var yDate = new Date(y.innerHTML);

            if(dir == "asc"){
                if(xDate > yDate){
                    shouldSwitch = true;
                    break;
                }
            }else if(dir == "desc"){
                if(xDate < yDate){
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch){
            rows[i].parentNode.insertBefore(rows[i+1],rows[i])
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc"){
                dir = "desc";
                switching = true;
            }
        }
    }
}

function sortTable(n, table_id){
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
    table = document.getElementById(table_id);
    switching = true;
    dir = "asc";

    while (switching) {
        switching = false;
        rows = table.rows;
        for (i = 1; i < rows.length-1; i++) {
            shouldSwitch = false;
            x = rows[i].getElementsByTagName("td")[n];
            y = rows[i+1].getElementsByTagName("td")[n];

            if(dir == "asc"){
                if(x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }
            }else if(dir == "desc"){
                if(x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()){
                    shouldSwitch = true;
                    break;
                }
            }
        }

        if (shouldSwitch){
            rows[i].parentNode.insertBefore(rows[i+1],rows[i])
            switching = true;
            switchcount ++;
        } else {
            if (switchcount == 0 && dir == "asc"){
                dir = "desc";
                switching = true;
            }
        }

    }

}