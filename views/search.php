<?php include 'partial/head.php' ?>
<body>
    <header>
        <h1>The Bouquiniste</h1>
        <nav>
            <ul class="nav__links">
                <li><a href="/">strona główna</a></li>
                <li><input class="danger textify" type="submit" name="delete_btn" value="usuń" form="bookList"></li>
            </ul>
        </nav>
    </header>
    <main>
        <section class="container">
            <div class="row">
                <div class="col-12">

                    <h2>Wyszukiwanie</h2>
                    <hr>

                    <div class="row">
                    <div class="col-3 col-3-sm">
                        <label for="title">Tytuł: </label>
                        <input type="text" name="title" id="titleSearch"><br>
                    </div>
                    <div class="col-3 col-3-sm">
                        <label for="author">Autor: </label>
                        <input type="text" name="author" id="authorSearch"><br>
                    </div>
                    <div class="col-2 col-2-sm">
                        <label for="genre">Gatunek: </label>
                        <input type="text" name="genre" id="genreSearch"><br>
                    </div>
                    <div class="col-2 col-2-sm">
                        <label for="year">Rok: </label>
                        <input type="text" name="year" id="yearSearch">
                    </div>
                    <div class="col-2 col-2-sm">  
                        <label for="condition">Stan: </label>
                        <select name="condition" id="conditionSearch">
                            <option value="">---</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <form id="bookList" action="formEvent" method="POST">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tytuł</th>
                                <th>Autor</th>
                                <th>Gatunek</th>
                                <th>Rok</th>
                                <th>Stan</th>
                            </tr>
                        </thead>
                        <tbody id="tableData">

                            <?php if (is_array($books)): ?>
                                <?php foreach ($books as $book): ?>
                                    
                                <tr>
                                    <td><input type="checkbox" name="id[]" value="<?php echo $book["id"]?>" /></td>
                                    <td><?php echo $book["title"] ?></td>
                                    <td><?php echo $book["author"] ?></td>
                                    <td><?php echo $book["genre"] ?></td>
                                    <td><?php echo $book["year"] ?></td>
                                    <td><?php echo $book["condition"] ?></td>
                                </tr>

                                <?php endforeach; ?>
                            
                                <?php else: ?>
                                    <div class="box box-info">
                                        <p>Baza danych jest pusta!</p>
                                    </div>

                            <?php endif; ?>
                            
                        </tbody>
                    </table>
                    </form>
                </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script>

const array = <?php echo($jsonArray) ?>;

document.getElementById('titleSearch').addEventListener('input', (e) => {
    buildTable(search());
})

document.getElementById('authorSearch').addEventListener('input', (e) => {
    buildTable(search());
})

document.getElementById('genreSearch').addEventListener('input', (e) => {
    buildTable(search());
})

document.getElementById('yearSearch').addEventListener('input', (e) => {
    buildTable(search());
})

document.getElementById('conditionSearch').addEventListener('input', (e) => {
    buildTable(search());
})



function search() {
    var filteredData = [];

    for (var i = 0; i < array.length; i++) {

        if (array[i].title.toLowerCase().includes(document.getElementById('titleSearch').value) && 
            array[i].author.toLowerCase().includes(document.getElementById('authorSearch').value) &&
            array[i].genre.toLowerCase().includes(document.getElementById('genreSearch').value) &&
            array[i].year.toLowerCase().includes(document.getElementById('yearSearch').value) &&
            array[i].condition.toLowerCase().includes(document.getElementById('conditionSearch').value)) {

            filteredData.push(array[i]);
        }
    }

    return filteredData;
}

function buildTable(data) {

    var table = document.getElementById('tableData');

    table.innerHTML = "";

    for (var i = 0; i < data.length; i++) {
        var row =   `<tr>
                        <td><input type="checkbox" name="id[]" value="${data[i].id}"/></td>
                        <td>${data[i].title}</td>
                        <td>${data[i].author}</td>
                        <td>${data[i].genre}</td>
                        <td>${data[i].year}</td>
                        <td>${data[i].condition}</td>
                    </tr>`;
        
        table.innerHTML += row;
    }
}

</script>
</html>