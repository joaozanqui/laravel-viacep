function makeEvent(type = 'success', msg = 'alert', position = '') {
    let alerts = $('#alerts');
    let alert = `<div class="alert ${type} ${position}">${msg}</div>`
    let length = alerts.append(alert)[0].children.length
    alert = $('#alerts')[0].children[length - 1]

    setTimeout(() => {
        toggleClass(alert);
    }, 1);

    setTimeout(() => {
        toggleClass(alert);
        setTimeout(() => {
            $(alert).remove();
            $(alert).removeClass('top')
        }, 500);
    }, 5000);
}

function toggleClass(element) {
    if ($(element).hasClass('active')) {
        $(element).removeClass('active')
    } else
        $(element).addClass('active')
}