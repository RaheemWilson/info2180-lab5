window.onload = function () {
    let btns = document.querySelectorAll(".lookup")
    let city = document.getElementById("city");

    btns.forEach(btn => {
        btn.onclick = function () {
            let country = document.getElementById("country").value;
            let result = document.getElementById("result");
    
            let context = btn.id === "city" ? "cities" : "";
    
            fetch(`http://localhost/info2180-lab5/world.php?country=${country.trim()}&context=${context}`)
            .then(response => {
                if(response.ok){
                    return response.text();
                }
                else{
                    throw new Error(`An error has occured: ${response.status}`);
                }
            })
            .then(data => {
                result.innerHTML = data;
            })
            .catch(err => {
                console.log(err);
            })
        }
    });
    
   
}