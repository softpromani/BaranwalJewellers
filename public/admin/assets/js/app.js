function readAndDisplayImage(input, displayElement) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $(displayElement).attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
