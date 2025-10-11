import { Pane } from 'https://cdn.skypack.dev/tweakpane@4.0.4';

// Benzersiz section elementimizi seçelim
const keypadSection = document.querySelector('#interactive-keypad-section');
console.log(keypadSection);
const config = {
    theme: 'system',
    muted: false,
    exploded: false,
    one: {
        travel: 26,
        text: 'ok',
        key: 'o',
        hue: 114,
        saturation: 1.4,
        brightness: 1.2,
        buttonElement: keypadSection.querySelector('#interactive-keypad-one'),
        textElement: keypadSection.querySelector('#interactive-keypad-one .interactive-keypad-text')
    },
    two: {
        travel: 26,
        text: 'go',
        key: 'g',
        hue: 0,
        saturation: 0,
        brightness: 1.4,
        buttonElement: keypadSection.querySelector('#interactive-keypad-two'),
        textElement: keypadSection.querySelector('#interactive-keypad-two .interactive-keypad-text')
    },
    three: {
        travel: 18,
        text: 'create.',
        key: 'Enter',
        hue: 0,
        saturation: 0,
        brightness: 0.4,
        buttonElement: keypadSection.querySelector('#interactive-keypad-three'),
        textElement: keypadSection.querySelector('#interactive-keypad-three .interactive-keypad-text')
    }
};

const clickAudio = new Audio('https://cdn.freesound.org/previews/378/378085_6260145-lq.mp3');
clickAudio.muted = config.muted;

const ctrl = new Pane({
    title: 'config',
    expanded: false
});

const update = () => {
    document.documentElement.dataset.theme = config.theme;
    keypadSection.dataset.exploded = config.exploded;
};

const sync = event => {
    if (!document.startViewTransition || event.target.controller.view.labelElement.innerText !== 'theme') return update();
    document.startViewTransition(() => update());
};

ctrl.addBinding(config, 'muted').on('change', () => clickAudio.muted = config.muted);
ctrl.addBinding(config, 'exploded', { label: 'explode' }).on('change', () => keypadSection.dataset.exploded = config.exploded);
ctrl.addBinding(config, 'theme', {
    label: 'theme',
    options: { system: 'system', light: 'light', dark: 'dark' }
});

let recorder;
const ids = ['one', 'two', 'three'];

const recordKey = config => event => {
    config.key = event.key;
    ctrl.refresh();
};

for (const id of ids) {
    const keyFolder = ctrl.addFolder({ title: `key ${id}`, expanded: false });
    keyFolder.addBinding(config[id], 'text', { label: 'text' }).on('change', () => {
        config[id].textElement.innerText = config[id].text;
    });

    config[id].buttonElement.style.setProperty('--travel', config[id].travel);
    config[id].buttonElement.style.setProperty('--saturate', config[id].saturation);
    config[id].buttonElement.style.setProperty('--hue', config[id].hue);
    config[id].buttonElement.style.setProperty('--brightness', config[id].brightness);

    keyFolder.addBinding(config[id], 'travel', { min: 1, max: 50, step: 1 }).on('change', () => {
        config[id].buttonElement.style.setProperty('--travel', config[id].travel);
    });
    keyFolder.addBinding(config[id], 'hue', { min: 0, max: 360, step: 1 }).on('change', () => {
        config[id].buttonElement.style.setProperty('--hue', config[id].hue);
    });
    keyFolder.addBinding(config[id], 'saturation', { min: 0, max: 2, step: 0.1 }).on('change', () => {
        config[id].buttonElement.style.setProperty('--saturate', config[id].saturation);
    });
    keyFolder.addBinding(config[id], 'brightness', { min: 0, max: 2, step: 0.1 }).on('change', () => {
        config[id].buttonElement.style.setProperty('--brightness', config[id].brightness);
    });
    keyFolder.addBinding(config[id], 'key', { disabled: true });
    keyFolder.addButton({ title: 'Record Key' }).on('click', () => {
        if (recorder) window.removeEventListener('keypress', recorder);
        recorder = recordKey(config[id]);
        window.addEventListener('keypress', recorder, { once: true });
    });

    config[id].buttonElement.addEventListener('pointerdown', () => {
        if (!config.muted) {
            clickAudio.currentTime = 0;
            clickAudio.play();
        }
    });
}

window.addEventListener('keydown', event => {
    for (const id of ids) {
        if (event.key === config[id].key) {
            config[id].buttonElement.dataset.pressed = true;
            if (!config.muted) {
                clickAudio.currentTime = 0;
                clickAudio.play();
            }
        }
    }
});

window.addEventListener('keyup', event => {
    for (const id of ids) {
        if (event.key === config[id].key)
            config[id].buttonElement.dataset.pressed = false;
    }
});

ctrl.on('change', sync);
update();

keypadSection.querySelector('.interactive-keypad-container').style.setProperty('opacity', 1);
keypadSection.querySelector('form').addEventListener('submit', event => event.preventDefault());
