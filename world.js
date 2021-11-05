window.onload = function () {
    let btn = document.getElementById("lookup");
    
    btn.onclick = function () {
        let country = document.getElementById("country").value;
        let result = document.getElementById("result")

        fetch(`http://localhost/info2180-lab5/world.php?country=${country.trim()}`)
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
}