function searchBlog() {
    var searchQuery = document.getElementById('search-bar').value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../controller/searchBlog.php?search=' + encodeURIComponent(searchQuery), true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var table = document.getElementById('blog-table');
            table.innerHTML = `
                <tr id="blog-table-header">
                    <th>Title</th>
                    <th>Author</th>
                    <th>Date</th>
                    <th>Summary</th>
                </tr>` + xhr.responseText;
        }
    };
    xhr.send();
}
