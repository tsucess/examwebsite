let filter = document.getElementById("filter");
let year = document.getElementById("years");
let session = document.getElementById("sessions");
let subject = document.getElementById("subjects");
let other = document.getElementById("others");

let tBody = document.getElementById("table_body");

filter.addEventListener('change', () => {

    if (filter.value == 'default') {
        session.style.display = "none";
        other.style.display = "none";
        year.style.display = "none";
        All();
    } else if (filter.value == 'year') {
        year.style.display = "flex";
        session.style.display = "none";
        other.style.display = "none";
        year.addEventListener('change', yearOnly);


    } else if (filter.value == 'yearsession') {
        year.style.display = "flex";
        session.style.display = "flex";
        other.style.display = "none";
        session.addEventListener('change', yearSession);



    } else if (filter.value == 'others') {
        other.style.display = "flex";
        year.style.display = "none";
        session.style.display = "none";
        other.addEventListener('change', others);

    } else {
        session.style.display = "none";
        other.style.display = "none";
        year.style.display = "none";

    }



});





function All() {
    let filters = 'all';
    let filterValue = filter.value;
    let xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (this.readyState == 4 & this.status == 200) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);
                
                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr>
                            <td>${item.date_time}</td>
                            <td>${item.session == 1 ? 'MAY/JUNE' : 'OCT/NOV'}</td>
                            <td>${item.firstname} ${item.lastname}</td>
                            <td>${item.subject}</td>
                            <td>${item.payment_status}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "5">No Result Found</td>
                    </tr>
                    `;
                   
                    }
                tBody.innerHTML = output;

            }
        }
    }


    xhr.open('POST', "../php/filter-function.php", true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
}

function yearOnly() {
    let filters = 'year';
    let filterValue = year.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/filter-function.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);
                
                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr>
                            <td>${item.date_time}</td>
                            <td>${item.session == 1 ? 'MAY/JUNE' : 'OCT/NOV'}</td>
                            <td>${item.firstname} ${item.lastname}</td>
                            <td>${item.subject}</td>
                            <td>${item.payment_status}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "5">No Result Found</td>
                    </tr>
                    `;
                   
                    }
                tBody.innerHTML = output;

            }


        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filters=' + filters);
}


function yearSession() {
    let filters = 'yearsession';
    let filterYearValue = year.value;
    let filterValue = session.value;

    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/filter-function.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);
                
                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr>
                            <td>${item.date_time}</td>
                            <td>${item.session == 1 ? 'MAY/JUNE' : 'OCT/NOV'}</td>
                            <td>${item.firstname} ${item.lastname}</td>
                            <td>${item.subject}</td>
                            <td>${item.payment_status}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "5">No Result Found</td>
                    </tr>
                    `;
                   
                    }
                tBody.innerHTML = output;

            }


        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue + '&filteryearvalue='+filterYearValue +'&filters=' + filters);
}

function others() {
    let filters = 'others';
    let filterValue = other.value;
    let xhr = new XMLHttpRequest();
    xhr.open('POST', "../php/filter-function.php", true);
    xhr.onload = () => {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                let datas = JSON.parse(xhr.response);
                let data = datas;
                let output = "";
                console.log(datas);
                
                if (datas != "success") {
                    console.log(data);
                    for (let item of data) {

                        output += `
                        <tr>
                            <td>${item.date_time}</td>
                            <td>${item.session == 1 ? 'MAY/JUNE' : 'OCT/NOV'}</td>
                            <td>${item.firstname} ${item.lastname}</td>
                            <td>${item.subject}</td>
                            <td>${item.payment_status}</td>
                        </tr>
                        `;
                    }
                } else {
                    output += `
                    <tr>
                        <td colspan= "5">No Result Found</td>
                    </tr>
                    `;
                   
                    }
                tBody.innerHTML = output;

            }


        }
    }

    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('filtervalue=' + filterValue+'&filters='+filters);
}
