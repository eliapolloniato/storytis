const apiUrl = 'https://api.dicebear.com/7.x/adventurer/svg';

const avatarEl = document.getElementById('avatar-img');
const characterNameEl = document.getElementById('character-name');

const updateTimeout = 1000;

// Default avatar
avatarEl.src = `${apiUrl}?seed=Default`;

characterNameEl.addEventListener('input', () => {
    setTimeout(() => {
        if (characterNameEl.value === '') {
            avatarEl.src = `${apiUrl}?seed=Default`;
            return;
        }

        const characterName = characterNameEl.value;
        const url = `${apiUrl}?seed=${characterName}`;
        avatarEl.src = url;
    }, updateTimeout);
});