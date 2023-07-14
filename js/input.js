// モーダル
$(document).ready(function() {
  function showModal() {
    $("#successModal").modal("show");
  }

  // ページのURLに "success=1" のパラメータがある場合にモーダルを表示
  if (window.location.search.includes("success=1")) {
    showModal();
  }
});