
function searchuser() {
    var searchQuery = document.getElementById('search-bar').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../controller/search.php?search=' + encodeURIComponent(searchQuery), true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var tableContent = xhr.responseText;

            // Update the table's rows dynamically
            var table = document.getElementById('authorTable');
            table.innerHTML = `
                <tr>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>` + tableContent;
        }
    };
    xhr.send();
}
