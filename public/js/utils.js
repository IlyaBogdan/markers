function showForm(form) {
    
        if (form == "add"){
            document.getElementById('map').style.opacity = 0.5;
            document.getElementById('add-form').style.display = "block";
        }

        if (form == "close-form" || form != "add") {
            document.getElementById('map').style.opacity = 1;
            document.getElementById('add-form').style.display = "none";
        }
            

        if (form == "find") {
            let mobile = prompt("Input mobile for marker");
            if (!mobile) return;
            render(false, mobile);
        }
            
        if (form == "delete"){
            let id = prompt("Input id for marker");
            $.ajax({ 
                url: `http://localhost:8000/api/delete-marker/${id}`,
                method: "DELETE",
                success: function(data) {
                    alert(data);
                    render();
                }
            });
        }
}

function addMarker() {
    const form = document.getElementById('add-form');
    const fields = form.getElementsByTagName('input');
    const data = {
        "mobile": fields[0].value,
        "description": fields[1].value,
        "x": fields[2].value,
        "y": fields[3].value,
    };
    $.ajax({ 
        url: `http://localhost:8000/api/add-marker`,
        method: "PUT",
        headers: { "Content-type": "application/json" },
        data: JSON.stringify(data),
        success: function() {
            alert("Marker is added!");
            showForm("close-form");
            render();
        }
    });
}
