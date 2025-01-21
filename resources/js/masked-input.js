import Inputmask from 'inputmask';

const elements = document.querySelectorAll('.masked-input');
Inputmask().mask(elements);

window.Inputmask = Inputmask
