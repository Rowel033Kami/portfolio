function changeColor(color) {
    document.getElementById('content-area').style.backgroundColor = color;
    document.getElementById('content-area').style.color = color === 'black' ? 'white' : 'black';
}
