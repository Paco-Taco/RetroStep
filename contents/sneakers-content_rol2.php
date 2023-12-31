<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/c7fad14ccd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/styleSneakers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneakers</title>

</head>
<body>


    <div class="tab">
        <label class="tab-label" for="filterTab"><i class="fa-solid fa-chevron-down"></i></label>
        <input type="checkbox" id="filterTab" class="tab-checkbox">
        <div class="filter-container">
            <label for="brand-filter">Marca:</label>
            <select id="brand-filter" class="filter-dropdown">
                <option value="">Todas las marcas</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT brand_name FROM sneaker WHERE sneaker.deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $brandName = $row['brand_name'];
                    echo "<option value='$brandName'>$brandName</option>";
                }
                ?>
            </select>
            <label for="size-filter">Talla:</label>
            <select id="size-filter" class="filter-dropdown">
                <option value="">Todas las tallas</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT size_number FROM size";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sizeNumber = $row['size_number'];
                    echo "<option value='$sizeNumber'>$sizeNumber</option>";
                }
                ?>
            </select>

            <label for="model-filter">Modelo:</label>
            <select id="model-filter" class="filter-dropdown">
                <option value="">Todos los modelos</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT sneaker_name FROM sneaker WHERE deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $sneakerName = $row['sneaker_name'];
                    echo "<option value='$sneakerName'>$sneakerName</option>";
                }   
                ?>
            </select>

            <label for="category-filter">Categoría:</label>
            <select id="category-filter" class="filter-dropdown">
                <option value="">Todas las categorías</option>
                <?php
                require_once "connection.php";
                $sql = "SELECT DISTINCT category_name FROM sneaker WHERE deleted_at IS NULL";
                $result = mysqli_query($connection, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $categoryName = $row['category_name'];
                    echo "<option value='$categoryName'>$categoryName</option>";
                }
                ?>
            </select>

            <label for="search-input">Búsqueda:</label>
            <input type="search" id="search-input" placeholder="Search sneaker">
            <button id="search-button">Buscar</button>
        </div>
    </div>


    <div id="sneaker-container" class="TablaContainerSneakers">
    </div>


    <div id="fetched-sneaker-container" class="fetched-sneaker-container">
    </div>
    
    <div id="filtered-sneaker-container" class="filtered-sneaker-container">
    </div>

    <div id="not-found-msg" class="not-found-msg"><h2> No se encontraron resultados </h2></div>

 

</body>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="scripts/showSneakers-rol2.js"></script>
<script src="scripts/search.js"></script>
<script src="scripts/filter.js"></script>

</html>