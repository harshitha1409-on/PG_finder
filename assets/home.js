let session = {
    logged_in: false,
    interests: []
};

// Load current login session
async function loadSession() {
    try {
        const response = await fetch('api/session.php');
        session = await response.json();
        window.session = session;

        const greeting = document.getElementById('userGreeting');
        const authText = document.getElementById('authNavText');
        const authButton = document.querySelector('[data-bs-target="#authModal"]');

        if (greeting) {
            greeting.textContent = session.logged_in
                ? `Hi, ${session.name}`
                : '';
        }

        if (authText) {
            authText.textContent = session.logged_in
                ? 'Logout'
                : 'Login';
        }

        if (authButton) {
            authButton.onclick = function () {
                if (session.logged_in) {
                    logoutUser();
                } else {
                    const modal = bootstrap.Modal.getOrCreateInstance(
                        document.getElementById('authModal')
                    );
                    modal.show();
                }
            };
        }

    } catch (error) {
        console.error('Session error:', error);
    }
}


// LOGIN
const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const message = document.getElementById('authMessage');
        const button = loginForm.querySelector('button');

        button.disabled = true;
        button.textContent = 'Logging in...';
        message.textContent = '';

        try {
            const formData = new FormData(loginForm);
            formData.append('action', 'login');

            const response = await fetch('api/auth.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            message.textContent = data.message;

            if (data.success) {

                await loadSession();

                const modalElement =
                    document.getElementById('authModal');

                const modal =
                    bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                }

                location.reload();

            }

        } catch (error) {

            console.error('Login error:', error);

            message.textContent =
                'Login failed. Please try again.';

        } finally {

            button.disabled = false;
            button.textContent = 'Login';

        }
    });
}


// SIGN UP
const signupForm = document.getElementById('signupForm');

if (signupForm) {

    signupForm.addEventListener('submit', async function (e) {

        e.preventDefault();

        const message =
            document.getElementById('authMessage');

        const button =
            signupForm.querySelector('button');

        button.disabled = true;
        button.textContent = 'Creating account...';
        message.textContent = '';

        try {

            const formData = new FormData(signupForm);

            formData.append('action', 'signup');

            const response = await fetch('api/auth.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            message.textContent = data.message;

            if (data.success) {

                await loadSession();

                const modalElement =
                    document.getElementById('authModal');

                const modal =
                    bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                }

                location.reload();
            }

        } catch (error) {

            console.error('Signup error:', error);

            message.textContent =
                'Registration failed. Please try again.';

        } finally {

            button.disabled = false;
            button.textContent = 'Create account';

        }
    });
}


// HOMEPAGE CITY SEARCH
function goSearch(city) {

    city = (city || '').trim();

    if (!city) {
        window.location.href =
            'listings.php?city=Visakhapatnam';
        return;
    }

    const aliases = {
        vizag: 'Visakhapatnam',
        visakhapatnam: 'Visakhapatnam',
        bengaluru: 'Bengaluru'
    };

    city =
        aliases[city.toLowerCase()] || city;

    window.location.href =
        'listings.php?city=' +
        encodeURIComponent(city);
}


const homeSearch =
    document.getElementById('homeSearch');

if (homeSearch) {

    homeSearch.addEventListener('submit', function (e) {

        e.preventDefault();

        const city =
            document.getElementById('homeCity').value;

        goSearch(city);

    });
}


// LOGOUT
async function logoutUser() {

    try {

        const formData = new FormData();

        formData.append('action', 'logout');

        await fetch('api/auth.php', {
            method: 'POST',
            body: formData
        });

        location.reload();

    } catch (error) {

        console.error('Logout error:', error);

        location.reload();
    }
}


// Start
loadSession();
