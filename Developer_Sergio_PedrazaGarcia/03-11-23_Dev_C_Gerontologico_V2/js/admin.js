
document.getElementById('btn1').addEventListener('click', function() {
    setActiveButton('btn1');
    setActiveContent('content1');
});
document.getElementById('btn2').addEventListener('click', function() {
    setActiveButton('btn2');
    setActiveContent('content2');
});
document.getElementById('btn3').addEventListener('click', function() {
    setActiveButton('btn3');
    setActiveContent('content3');
});

function setActiveButton(id) {
    const buttons = document.getElementsByClassName('btn');
    for (let i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
}

function setActiveContent(id) {
    const contents = document.getElementsByClassName('content');
    for (let i = 0; i < contents.length; i++) {
        contents[i].classList.remove('active');
    }
    document.getElementById(id).classList.add('active');
}
