@if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies)

    {{-- @include('cookie-consent::dialogContents') --}}

    <div class="js-cookie-consent cookie-consent fixed justify-center w-screen bottom-0 inset-x-0 pb-2">
        <div class="max-screen mx-auto px-6 backdrop-blur-2xl">
            <div class="p-3" style="max-width:900px;margin:0 auto;">
                <div class="flex items-center justify-between flex-wrap md:flex-nowrap" style="display:flex;">
                    <div class="flex items-center md:inline">
                        <div class="flex flex-wrap text-black text-[15px] cookie-consent__message">
                            <p class="mr-2">Allowing cookies will enhance your experience on this website. We never collect your information.</p> @livewire('cookie-button')
                        </div>
                    </div>
                    <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                        <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-yellow-800 bg-yellow-400 hover:bg-yellow-300" style="background-color:#F4CE14;">
                            Allow Cookie
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        window.laravelCookieConsent = (function () {

            const COOKIE_VALUE = 1;
            const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

            function consentWithCookies() {
                setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE, {{ $cookieConsentConfig['cookie_lifetime'] }});
                hideCookieDialog();
            }

            function cookieExists(name) {
                return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
            }

            function hideCookieDialog() {
                const dialogs = document.getElementsByClassName('js-cookie-consent');

                for (let i = 0; i < dialogs.length; ++i) {
                    dialogs[i].style.display = 'none';
                }
            }

            function setCookie(name, value, expirationInDays) {
                const date = new Date();
                date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
                document.cookie = name + '=' + value
                    + ';expires=' + date.toUTCString()
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/{{ config('session.secure') ? ';secure' : null }}'
                    + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
            }

            if (cookieExists('{{ $cookieConsentConfig['cookie_name'] }}')) {
                hideCookieDialog();
            }

            const buttons = document.getElementsByClassName('js-cookie-consent-agree');

            for (let i = 0; i < buttons.length; ++i) {
                buttons[i].addEventListener('click', consentWithCookies);
            }

            return {
                consentWithCookies: consentWithCookies,
                hideCookieDialog: hideCookieDialog
            };
        })();
    </script>

@endif
