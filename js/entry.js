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

//レベルの〇をつける
function toggleCheckmark(element) {
    var isSelected = element.classList.contains("selected");

    // すでに選択されている場合は「〇」を削除する
    if (isSelected) {
        element.innerHTML = "";
        element.classList.remove("selected");
    } else {
        var selectedCells = document.getElementsByClassName("selected");

        // 同じ行の他のセルが選択されている場合は選択を解除する
        for (var i = 0; i < selectedCells.length; i++) {
            var selectedCell = selectedCells[i];
            if (selectedCell.parentNode === element.parentNode) {
                selectedCell.innerHTML = "";
                selectedCell.classList.remove("selected");
            }
        }

        // 選択されたセルに〇を追加する
        element.innerHTML = "〇";
        element.classList.add("selected");
    }
}


// radio button on/off
const radioButtons = document.querySelectorAll('input[type="radio"]');

const clearRadioButton = (radioButton) => {
  setTimeout(func =()=>{
    radioButton.checked = false;
  },100)
}

radioButtons.forEach(radioButton => {
  let queryStr = 'label[for="' + radioButton.id + '"]'
  let label = document.querySelector(queryStr)

  radioButton.addEventListener("mouseup", func=()=>{
    if(radioButton.checked){
      clearRadioButton(radioButton)
    }
  });

  if(label){
    label.addEventListener("mouseup", func=()=>{
      if(radioButton.checked){
        clearRadioButton(radioButton)
      }
    });
  }
});



