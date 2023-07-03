// アコーディオンメニューの動作を制御するJavaScript
document.addEventListener("DOMContentLoaded", function () {
    var accordionHeaders = document.querySelectorAll(".accordion-header");

    accordionHeaders.forEach(function (header) {
        header.addEventListener("click", function () {
            var accordionItem = this.parentElement;

            if (accordionItem.classList.contains("active")) {
                accordionItem.classList.remove("active");
            } else {
                accordionItem.classList.add("active");
            }
        });
    });
});


// セルの〇
function toggleCellState(cell) {
    var categoryCells = cell.parentNode.cells;
    var categoryCellIndex = cell.cellIndex;
    
    if (categoryCellIndex > 1 && cell.innerHTML === '') {
        // カテゴリ内のすべてのセルの内容をクリア
        for (var i = 2; i < categoryCells.length - 1; i++) {
            var categoryCell = categoryCells[i];
            if (i !== categoryCellIndex) {
                categoryCell.innerHTML = '';
            }
        }
        cell.innerHTML = '〇';
    } else if (categoryCellIndex > 1 && cell.innerHTML !== '') {
        cell.innerHTML = '';
    }
}


