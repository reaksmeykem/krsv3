@if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies)

    {{-- @include('cookie-consent::dialogContents') --}}

    <div class="js-cookie-consent cookie-consent fixed justify-center w-screen bottom-0 inset-x-0">
        <div class="max-screen mx-auto px-6 backdrop-blur-2xl">
            <div class="p-3" style="max-width:900px;margin:0 auto;">
                <div class="flex items-center justify-between flex-wrap md:flex-nowrap" style="display:flex; justify-content:space-between;">
                    <div class="flex items-center md:inline">
                        <div class="flex flex-wrap text-black text-[15px] cookie-consent__message" style="font-size:15px;">
                            <p class="mr-2 text-sm text-slate-800 dark:text-white">ការអនុញ្ញាតឲ្យមានខូឃី(Cookies)នឹងធ្វើឲ្យបទពិសោធន៍របស់អ្នកល្អប្រសើរឡើងនៅលើគេហទំព័រ នេះ។</p> <a class="text-[#2196f3] text-sm underline" href="{{ route('cookieConsent') }}" wire:navigate>ស្វែងយល់បន្ថែម</a>
                        </div>
                    </div>
                    <div class="mt-2 flex-shrink-0 w-full sm:mt-0 sm:w-auto">
                        <button class=" js-cookie-consent-agree cookie-consent__agree cursor-pointer flex items-center justify-center px-4 py-2 rounded-md text-sm font-medium text-white bg-[#2196f3]">
                            អនុញ្ញាតខូឃី
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
