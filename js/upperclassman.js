$(function () {
    const modal1 = $("#js-modal1");
    const overlay = $("#js-overlay");
    const close = $(".js-close");
    const open1 = $("#js-open1");

    const modal2 = $("#js-modal2");
    const open2 = $("#js-open2");

    const modal3 = $("#js-modal3");
    const open3 = $("#js-open3");

    const modal4 = $("#js-modal4");
    const open4 = $("#js-open4");

    const modal5 = $("#js-modal5");
    const open5 = $("#js-open5");

    const modal6 = $("#js-modal6");
    const open6 = $("#js-open6");

    const modal7 = $("#js-modal7");
    const open7 = $("#js-open7");

    const modal8 = $("#js-modal8");
    const open8 = $("#js-open8");

    const modal9 = $("#js-modal9");
    const open9 = $("#js-open9");



    open1.on('click', function () { //ボタンをクリックしたら
    modal1.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal1.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open2.on('click', function () { //ボタンをクリックしたら
    modal2.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal2.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open3.on('click', function () { //ボタンをクリックしたら
    modal3.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal3.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open4.on('click', function () { //ボタンをクリックしたら
    modal4.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal4.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open5.on('click', function () { //ボタンをクリックしたら
    modal5.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal5.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open6.on('click', function () { //ボタンをクリックしたら
    modal6.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal6.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open7.on('click', function () { //ボタンをクリックしたら
    modal7.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal7.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open8.on('click', function () { //ボタンをクリックしたら
    modal8.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal8.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });

    open9.on('click', function () { //ボタンをクリックしたら
    modal9.addClass("open"); // modalクラスにopenクラス付与
    overlay.addClass("open"); // overlayクラスにopenクラス付与
    });
    close.on('click', function () { //閉じる×ボタンをクリックしたら
    modal9.removeClass("open"); // overlayクラスからopenクラスを外す
    overlay.removeClass("open"); // overlayクラスからopenクラスを外す
    });   
});

function showPopup(popupNumber) {
    // すべてのポップアップを非表示にする
    const popups = document.querySelectorAll('.popup');
    popups.forEach(popup => popup.style.display = 'none');

    // 対応するポップアップを表示する
    const popup = document.getElementById(`popup${popupNumber}`);
    popup.style.display = 'block';
}

function hidePopup(popupId) {
    var popup = document.getElementById("popup" + popupId);
    popup.style.display = "none";
}