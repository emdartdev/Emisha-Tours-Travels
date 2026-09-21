<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\AnalyticsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TrackingService
{
    /**
     * Provider schema & definition registry
     */
    public const PROVIDERS = [
        // Web Analytics
        'ga4' => [
            'name' => 'Google Analytics 4',
            'category' => 'analytics',
            'icon' => 'google-analytics',
            'key_field' => 'ga4_measurement_id',
            'placeholder' => 'G-XXXXXXXXXX',
            'regex' => '/^G-[A-Z0-9]{6,15}$/i',
            'help' => 'Enter your GA4 Measurement ID starting with G-',
        ],
        'gtm' => [
            'name' => 'Google Tag Manager',
            'category' => 'analytics',
            'icon' => 'gtm',
            'key_field' => 'gtm_container_id',
            'placeholder' => 'GTM-XXXXXXX',
            'regex' => '/^GTM-[A-Z0-9]{4,10}$/i',
            'help' => 'Enter your GTM Container ID starting with GTM-',
        ],
        'clarity' => [
            'name' => 'Microsoft Clarity',
            'category' => 'analytics',
            'icon' => 'clarity',
            'key_field' => 'clarity_project_id',
            'placeholder' => 'e.g. abc123def4',
            'regex' => '/^[a-z0-9]{8,15}$/i',
            'help' => 'Microsoft Clarity Project ID (usually 10 alphanumeric characters)',
        ],
        'hotjar' => [
            'name' => 'Hotjar Heatmaps',
            'category' => 'analytics',
            'icon' => 'hotjar',
            'key_field' => 'hotjar_site_id',
            'placeholder' => 'e.g. 1234567',
            'regex' => '/^[0-9]{5,10}$/',
            'help' => 'Numeric Hotjar Site ID',
        ],
        'plausible' => [
            'name' => 'Plausible Analytics',
            'category' => 'analytics',
            'icon' => 'plausible',
            'key_field' => 'plausible_domain',
            'placeholder' => 'emishatours.com',
            'regex' => '/^[a-z0-9.-]+\.[a-z]{2,}$/i',
            'help' => 'Registered custom domain name on Plausible',
        ],
        'posthog' => [
            'name' => 'PostHog Analytics',
            'category' => 'analytics',
            'icon' => 'posthog',
            'key_field' => 'posthog_api_key',
            'placeholder' => 'phc_XXXXXXXXXXXXXXXXXXXXX',
            'regex' => '/^phc_[a-zA-Z0-9_-]{20,50}$/',
            'help' => 'PostHog Project API Key (phc_...)',
        ],

        // Social Media Pixels
        'meta' => [
            'name' => 'Meta Pixel (Facebook & Instagram)',
            'category' => 'social',
            'icon' => 'meta',
            'key_field' => 'meta_pixel_id',
            'placeholder' => 'e.g. 123456789012345',
            'regex' => '/^[0-9]{12,20}$/',
            'help' => '15-16 digit Meta Dataset / Pixel ID from Events Manager',
        ],
        'tiktok' => [
            'name' => 'TikTok Pixel',
            'category' => 'social',
            'icon' => 'tiktok',
            'key_field' => 'tiktok_pixel_id',
            'placeholder' => 'e.g. C123456789ABCDEF',
            'regex' => '/^[A-Z0-9]{10,25}$/i',
            'help' => 'TikTok Pixel Code from TikTok Ads Manager',
        ],
        'snapchat' => [
            'name' => 'Snapchat Pixel',
            'category' => 'social',
            'icon' => 'snapchat',
            'key_field' => 'snapchat_pixel_id',
            'placeholder' => 'e.g. xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
            'regex' => '/^[a-f0-9-]{32,36}$/i',
            'help' => 'Snapchat Pixel ID UUID string',
        ],
        'linkedin' => [
            'name' => 'LinkedIn Insight Tag',
            'category' => 'social',
            'icon' => 'linkedin',
            'key_field' => 'linkedin_partner_id',
            'placeholder' => 'e.g. 1234567',
            'regex' => '/^[0-9]{5,10}$/',
            'help' => 'LinkedIn Insight Partner ID',
        ],
        'pinterest' => [
            'name' => 'Pinterest Tag',
            'category' => 'social',
            'icon' => 'pinterest',
            'key_field' => 'pinterest_tag_id',
            'placeholder' => 'e.g. 2612345678901',
            'regex' => '/^[0-9]{10,18}$/',
            'help' => 'Numeric Pinterest Advertiser Tag ID',
        ],
        'twitter' => [
            'name' => 'X (Twitter) Pixel',
            'category' => 'social',
            'icon' => 'twitter',
            'key_field' => 'twitter_pixel_id',
            'placeholder' => 'e.g. o1234',
            'regex' => '/^[a-z0-9]{5,10}$/i',
            'help' => 'Twitter Pixel Universal Website Tag ID',
        ],
        'reddit' => [
            'name' => 'Reddit Pixel',
            'category' => 'social',
            'icon' => 'reddit',
            'key_field' => 'reddit_pixel_id',
            'placeholder' => 'e.g. t2_12345',
            'regex' => '/^[a-z0-9_]{5,20}$/i',
            'help' => 'Reddit Ads Pixel ID',
        ],
        'quora' => [
            'name' => 'Quora Pixel',
            'category' => 'social',
            'icon' => 'quora',
            'key_field' => 'quora_pixel_id',
            'placeholder' => 'e.g. 1234567890abcdef',
            'regex' => '/^[a-f0-9]{16,36}$/i',
            'help' => 'Quora Pixel ID hex string',
        ],

        // Advertising Networks
        'google_ads' => [
            'name' => 'Google Ads Conversion Tracking',
            'category' => 'ads',
            'icon' => 'google-ads',
            'key_field' => 'google_ads_conversion_id',
            'placeholder' => 'AW-XXXXXXXXX',
            'regex' => '/^AW-[0-9]{8,12}$/i',
            'help' => 'Google Ads Conversion Tag ID (AW-...)',
        ],
        'microsoft_ads' => [
            'name' => 'Microsoft Advertising (Bing UET)',
            'category' => 'ads',
            'icon' => 'microsoft-ads',
            'key_field' => 'bing_uet_tag_id',
            'placeholder' => 'e.g. 12345678',
            'regex' => '/^[0-9]{6,12}$/',
            'help' => 'Bing Ads Universal Event Tracking (UET) Tag ID',
        ],
        'taboola' => [
            'name' => 'Taboola Pixel',
            'category' => 'ads',
            'icon' => 'taboola',
            'key_field' => 'taboola_pixel_id',
            'placeholder' => 'e.g. 1234567',
            'regex' => '/^[0-9]{6,12}$/',
            'help' => 'Taboola Account / Pixel ID',
        ],
        'outbrain' => [
            'name' => 'Outbrain Amplify Pixel',
            'category' => 'ads',
            'icon' => 'outbrain',
            'key_field' => 'outbrain_pixel_id',
            'placeholder' => 'e.g. 00abcdef123456',
            'regex' => '/^[a-z0-9]{10,24}$/i',
            'help' => 'Outbrain Pixel Marketer ID',
        ],

        // Search Engine Verification Meta
        'google_verification' => [
            'name' => 'Google Search Console Verification',
            'category' => 'verification',
            'icon' => 'google-g',
            'key_field' => 'google_site_verification',
            'placeholder' => 'e.g. abcdefghijklmnopqrstuvwxyz0123456789',
            'regex' => '/^[a-zA-Z0-9_-]{20,70}$/',
            'help' => 'Google site verification meta content code',
        ],
        'bing_verification' => [
            'name' => 'Bing Webmaster Tools Verification',
            'category' => 'verification',
            'icon' => 'bing',
            'key_field' => 'bing_site_verification',
            'placeholder' => 'e.g. 1234567890ABCDEF1234567890ABCDEF',
            'regex' => '/^[a-fA-F0-9]{32}$/',
            'help' => '32-character Bing verification hex token',
        ],
        'yandex_verification' => [
            'name' => 'Yandex Webmaster Verification',
            'category' => 'verification',
            'icon' => 'yandex',
            'key_field' => 'yandex_verification',
            'placeholder' => 'e.g. 1234567890abcdef',
            'regex' => '/^[a-f0-9]{16,32}$/i',
            'help' => 'Yandex verification content code',
        ],
        'baidu_verification' => [
            'name' => 'Baidu Search Verification',
            'category' => 'verification',
            'icon' => 'baidu',
            'key_field' => 'baidu_verification',
            'placeholder' => 'e.g. codeva-abcdef1234',
            'regex' => '/^[a-zA-Z0-9_-]{10,40}$/',
            'help' => 'Baidu search verification token',
        ],
    ];

    /**
     * Get single setting helper
     */
    public function getSetting(string $key, $default = null)
    {
        return Setting::get($key, $default);
    }

    /**
     * Check if a specific provider is configured and enabled
     */
    public function isProviderEnabled(string $providerKey): bool
    {
        $enabled = Setting::get("tracking_{$providerKey}_enabled", '1');
        if ($enabled === '0' || $enabled === false) {
            return false;
        }

        $config = self::PROVIDERS[$providerKey] ?? null;
        if (!$config) {
            return false;
        }

        $val = Setting::get($config['key_field']);
        return !empty($val);
    }

    /**
     * Render all active tracking scripts into <head>
     */
    public function renderHeadScripts(): string
    {
        return Cache::remember('tracking_head_scripts_html', 300, function () {
            $html = "<!-- Emisha Marketing & Analytics Engine -->\n";

            // 1. Search Engine Verification Meta Tags
            $gVer = Setting::get('google_site_verification');
            if ($gVer && $this->isProviderEnabled('google_verification')) {
                $html .= '<meta name="google-site-verification" content="' . htmlspecialchars($gVer, ENT_QUOTES) . '">' . "\n";
            }
            $bVer = Setting::get('bing_site_verification');
            if ($bVer && $this->isProviderEnabled('bing_verification')) {
                $html .= '<meta name="msvalidate.01" content="' . htmlspecialchars($bVer, ENT_QUOTES) . '">' . "\n";
            }
            $yVer = Setting::get('yandex_verification');
            if ($yVer && $this->isProviderEnabled('yandex_verification')) {
                $html .= '<meta name="yandex-verification" content="' . htmlspecialchars($yVer, ENT_QUOTES) . '">' . "\n";
            }
            $baiduVer = Setting::get('baidu_verification');
            if ($baiduVer && $this->isProviderEnabled('baidu_verification')) {
                $html .= '<meta name="baidu-site-verification" content="' . htmlspecialchars($baiduVer, ENT_QUOTES) . '">' . "\n";
            }

            // Global Emisha Client DataLayer & Event Dispatcher
            $html .= '<script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                window.emishaAnalytics = {
                    consent: localStorage.getItem("emisha_cookie_consent") || "pending",
                    track: function(eventName, params) {
                        try {
                            if (window.gtag) gtag("event", eventName, params);
                            if (window.fbq) fbq("trackCustom", eventName, params);
                            if (window.ttq) ttq.track(eventName, params);
                            if (window.clarity) window.clarity("event", eventName);
                            // Server-side telemetry beacon
                            if (navigator.sendBeacon) {
                                var payload = new Blob([JSON.stringify({
                                    event_name: eventName,
                                    metadata: params,
                                    page_url: window.location.href,
                                    page_title: document.title
                                })], { type: "application/json" });
                                navigator.sendBeacon("/api/tracking/event", payload);
                            }
                        } catch(e) { console.debug("Tracking error:", e); }
                    }
                };
            </script>' . "\n";

            // 2. Google Tag Manager (GTM)
            $gtmId = Setting::get('gtm_container_id');
            if ($gtmId && $this->isProviderEnabled('gtm')) {
                $gtmIdSafe = htmlspecialchars($gtmId, ENT_QUOTES);
                $html .= "<!-- Google Tag Manager -->\n";
                $html .= "<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                    })(window,document,'script','dataLayer','{$gtmIdSafe}');</script>\n";
                $html .= "<!-- End Google Tag Manager -->\n";
            }

            // 3. Google Analytics 4 (GA4) & Google Ads
            $ga4Id = Setting::get('ga4_measurement_id');
            $gAdsId = Setting::get('google_ads_conversion_id');
            $primaryGtagId = $ga4Id ?: $gAdsId;

            if ($primaryGtagId && ($this->isProviderEnabled('ga4') || $this->isProviderEnabled('google_ads'))) {
                $primarySafe = htmlspecialchars($primaryGtagId, ENT_QUOTES);
                $html .= "<!-- Google Analytics 4 / Google Ads -->\n";
                $html .= "<script async src=\"https://www.googletagmanager.com/gtag/js?id={$primarySafe}\"></script>\n";
                $html .= "<script>\n";
                $html .= "  gtag('js', new Date());\n";
                if ($ga4Id && $this->isProviderEnabled('ga4')) {
                    $html .= "  gtag('config', '" . htmlspecialchars($ga4Id, ENT_QUOTES) . "', { 'send_page_view': true });\n";
                }
                if ($gAdsId && $this->isProviderEnabled('google_ads')) {
                    $html .= "  gtag('config', '" . htmlspecialchars($gAdsId, ENT_QUOTES) . "');\n";
                }
                $html .= "</script>\n";
            }

            // 4. Meta Pixel (Facebook & Instagram)
            $metaPixelId = Setting::get('meta_pixel_id');
            if ($metaPixelId && $this->isProviderEnabled('meta')) {
                $metaSafe = htmlspecialchars($metaPixelId, ENT_QUOTES);
                $html .= "<!-- Meta Pixel Code -->\n";
                $html .= "<script>
                    !function(f,b,e,v,n,t,s)
                    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                    fbq('init', '{$metaSafe}');
                    fbq('track', 'PageView');
                </script>\n";
                $html .= "<noscript><img height=\"1\" width=\"1\" style=\"display:none\" src=\"https://www.facebook.com/tr?id={$metaSafe}&ev=PageView&noscript=1\"/></noscript>\n";
                $html .= "<!-- End Meta Pixel Code -->\n";
            }

            // 5. Microsoft Clarity
            $clarityId = Setting::get('clarity_project_id');
            if ($clarityId && $this->isProviderEnabled('clarity')) {
                $claritySafe = htmlspecialchars($clarityId, ENT_QUOTES);
                $html .= "<!-- Microsoft Clarity -->\n";
                $html .= "<script type=\"text/javascript\">
                    (function(c,l,a,r,i,t,y){
                        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                        t=l.createElement(r);t.async=1;t.src=\"https://www.clarity.ms/tag/\"+i;
                        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
                    })(window, document, \"clarity\", \"script\", \"{$claritySafe}\");
                </script>\n";
            }

            // 6. TikTok Pixel
            $ttPixelId = Setting::get('tiktok_pixel_id');
            if ($ttPixelId && $this->isProviderEnabled('tiktok')) {
                $ttSafe = htmlspecialchars($ttPixelId, ENT_QUOTES);
                $html .= "<!-- TikTok Pixel -->\n";
                $html .= "<script>
                    !function (w, d, t) {
                    w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=[\"page\",\"track\",\"identify\",\"instances\",\"debug\",\"on\",\"off\",\"once\",\"ready\",\"alias\",\"group\",\"enableCookie\",\"disableCookie\"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i=\"https://analytics.tiktok.com/i18n/pixel/events.js\";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement(\"script\");o.type=\"text/javascript\",o.async=!0,o.src=i+\"?sdkid=\"+e+\"&lib=\"+t;var a=document.getElementsByTagName(\"script\")[0];a.parentNode.insertBefore(o,a)};
                    ttq.load('{$ttSafe}');
                    ttq.page();
                    }(window, document, 'ttq');
                </script>\n";
            }

            // 7. Hotjar
            $hotjarId = Setting::get('hotjar_site_id');
            if ($hotjarId && $this->isProviderEnabled('hotjar')) {
                $hjSafe = (int) $hotjarId;
                $html .= "<!-- Hotjar Tracking Code -->\n";
                $html .= "<script>
                    (function(h,o,t,j,a,r){
                        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                        h._hjSettings={hjid:{$hjSafe},hjsv:6};
                        a=o.getElementsByTagName('head')[0];
                        r=o.createElement('script');r.async=1;
                        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                        a.appendChild(r);
                    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
                </script>\n";
            }

            // 8. Plausible
            $plausibleDomain = Setting::get('plausible_domain');
            if ($plausibleDomain && $this->isProviderEnabled('plausible')) {
                $plausibleSafe = htmlspecialchars($plausibleDomain, ENT_QUOTES);
                $html .= "<script defer data-domain=\"{$plausibleSafe}\" src=\"https://plausible.io/js/script.js\"></script>\n";
            }

            // 9. PostHog
            $posthogKey = Setting::get('posthog_api_key');
            $posthogHost = Setting::get('posthog_api_host', 'https://us.i.posthog.com');
            if ($posthogKey && $this->isProviderEnabled('posthog')) {
                $phKeySafe = htmlspecialchars($posthogKey, ENT_QUOTES);
                $phHostSafe = htmlspecialchars($posthogHost, ENT_QUOTES);
                $html .= "<script>
                    !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split('.');2==o.length&&(t=t[o[0]],e=o[1]),t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}}(p=t.createElement('script')).type='text/javascript',p.async=!0,p.src=s.api_host+'/static/array.js',(r=t.getElementsByTagName('script')[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a='posthog',u.people=u.people||[],u.toString=function(t){var e='posthog';return'posthog'!==a&&(e+='.'+a),t||(e+=' (stub)'),e},u.people.toString=function(){return u.toString(1)+'.people (stub)'},o='capture identify alias people.set people.set_once set_config register register_once unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled onFeatureFlags getFeatureFlag getFeatureFlagPayload reloadFeatureFlags group updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures getActiveMatchingSurveys getSurveys'.split(' ');n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
                    posthog.init('{$phKeySafe}',{api_host:'{$phHostSafe}'})
                </script>\n";
            }

            // 10. LinkedIn Insight Tag
            $linkedInId = Setting::get('linkedin_partner_id');
            if ($linkedInId && $this->isProviderEnabled('linkedin')) {
                $liSafe = htmlspecialchars($linkedInId, ENT_QUOTES);
                $html .= "<script type=\"text/javascript\">
                    _linkedin_partner_id = \"{$liSafe}\";
                    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
                    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
                </script>\n";
                $html .= "<script type=\"text/javascript\">
                    (function(l) {
                    if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
                    window.lintrk.q=[]}
                    var s = document.getElementsByTagName(\"script\")[0];
                    var b = document.createElement(\"script\");
                    b.type = \"text/javascript\";b.async = true;
                    b.src = \"https://snap.licdn.com/li.lms-analytics/insight.min.js\";
                    s.parentNode.insertBefore(b, s);})(window.lintrk);
                </script>\n";
            }

            // 11. X (Twitter) Pixel
            $twitterId = Setting::get('twitter_pixel_id');
            if ($twitterId && $this->isProviderEnabled('twitter')) {
                $twSafe = htmlspecialchars($twitterId, ENT_QUOTES);
                $html .= "<script>
                    !function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
                    },s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='https://static.ads-twitter.com/uwt.js',
                    a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
                    twq('config','{$twSafe}');
                </script>\n";
            }

            // 12. Custom Head Script (Admin defined)
            $customHead = Setting::get('custom_head_scripts');
            if ($customHead) {
                $html .= "<!-- Custom Head Code -->\n" . $customHead . "\n";
            }

            return $html;
        });
    }

    /**
     * Render GTM noscript in <body> start
     */
    public function renderBodyStartScripts(): string
    {
        $gtmId = Setting::get('gtm_container_id');
        if ($gtmId && $this->isProviderEnabled('gtm')) {
            $gtmIdSafe = htmlspecialchars($gtmId, ENT_QUOTES);
            return "<!-- Google Tag Manager (noscript) -->\n" .
                   "<noscript><iframe src=\"https://www.googletagmanager.com/ns.html?id={$gtmIdSafe}\" height=\"0\" width=\"0\" style=\"display:none;visibility:hidden\"></iframe></noscript>\n" .
                   "<!-- End Google Tag Manager (noscript) -->\n";
        }

        return '';
    }

    /**
     * Render Custom Body Scripts at footer
     */
    public function renderBodyEndScripts(): string
    {
        $customBody = Setting::get('custom_body_scripts');
        return $customBody ? "<!-- Custom Footer Tracking Code -->\n" . $customBody . "\n" : '';
    }

    /**
     * Record a server-side analytics / telemetry event
     */
    public function recordEvent(string $eventName, array $data = [], ?Request $request = null): AnalyticsEvent
    {
        $req = $request ?: request();
        $sessionId = $req->session()->getId() ?: 'guest_' . md5($req->ip() . $req->userAgent());
        
        $utm = $this->getUtmFromSessionOrRequest($req);

        return AnalyticsEvent::create([
            'session_id' => $sessionId,
            'user_id' => $req->user()?->id,
            'event_name' => $eventName,
            'event_category' => $data['category'] ?? $this->categorizeEvent($eventName),
            'page_url' => $data['page_url'] ?? $req->fullUrl(),
            'page_title' => $data['page_title'] ?? null,
            'referrer' => $data['referrer'] ?? $req->headers->get('referer'),
            'utm_source' => $utm['utm_source'] ?? null,
            'utm_medium' => $utm['utm_medium'] ?? null,
            'utm_campaign' => $utm['utm_campaign'] ?? null,
            'utm_term' => $utm['utm_term'] ?? null,
            'utm_content' => $utm['utm_content'] ?? null,
            'event_value' => $data['event_value'] ?? $data['value'] ?? null,
            'currency' => $data['currency'] ?? 'BDT',
            'metadata' => $data['metadata'] ?? $data,
            'ip_address' => $req->ip(),
            'user_agent' => $req->userAgent(),
        ]);
    }

    /**
     * Extract UTM tags from request or active session
     */
    public function getUtmFromSessionOrRequest(Request $request): array
    {
        $utmKeys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];
        $utm = [];

        foreach ($utmKeys as $key) {
            $val = $request->query($key) ?: session()->get($key);
            if ($val) {
                $utm[$key] = $val;
            }
        }

        return $utm;
    }

    /**
     * Event categorizer
     */
    protected function categorizeEvent(string $eventName): string
    {
        return match ($eventName) {
            'page_view' => 'engagement',
            'tour_inquiry', 'visa_application', 'ticket_request', 'contact_message' => 'conversion',
            'search', 'filter_applied', 'gallery_view', 'destination_view' => 'engagement',
            'whatsapp_click', 'call_click', 'email_click' => 'lead',
            'user_login', 'user_signup', 'user_logout' => 'user',
            default => 'custom',
        };
    }

    /**
     * Calculate global tracking health scorecard
     */
    public function getTrackingHealthSummary(): array
    {
        $providers = self::PROVIDERS;
        $configuredCount = 0;
        $enabledCount = 0;
        $statuses = [];

        foreach ($providers as $key => $conf) {
            $val = Setting::get($conf['key_field']);
            $isEnabled = $this->isProviderEnabled($key);
            $hasValue = !empty($val);

            if ($hasValue) {
                $configuredCount++;
                if ($isEnabled) {
                    $enabledCount++;
                    $status = 'connected';
                } else {
                    $status = 'disabled';
                }
            } else {
                $status = 'not_configured';
            }

            $statuses[$key] = [
                'name' => $conf['name'],
                'category' => $conf['category'],
                'key_field' => $conf['key_field'],
                'value' => $val,
                'status' => $status,
                'enabled' => $isEnabled,
                'is_valid' => $hasValue ? (bool) preg_match($conf['regex'], trim($val)) : false,
            ];
        }

        // Essential platforms for health score calculation
        $corePlatforms = ['ga4', 'gtm', 'meta', 'google_verification', 'clarity'];
        $coreHealthy = 0;
        foreach ($corePlatforms as $cp) {
            if (!empty($statuses[$cp]['value']) && $statuses[$cp]['enabled']) {
                $coreHealthy++;
            }
        }

        $healthScore = count($corePlatforms) > 0 ? round(($coreHealthy / count($corePlatforms)) * 100) : 0;

        return [
            'total_supported' => count($providers),
            'configured_count' => $configuredCount,
            'enabled_count' => $enabledCount,
            'health_score' => $healthScore,
            'statuses' => $statuses,
        ];
    }

    /**
     * Test & verify a single provider connection format
     */
    public function verifyProviderConnection(string $providerKey, string $value): array
    {
        $config = self::PROVIDERS[$providerKey] ?? null;
        if (!$config) {
            return [
                'status' => 'error',
                'message' => 'Unknown tracking provider identifier.',
            ];
        }

        $trimmed = trim($value);
        if (empty($trimmed)) {
            return [
                'status' => 'warning',
                'message' => "{$config['name']} ID is empty or not configured.",
            ];
        }

        $isValid = (bool) preg_match($config['regex'], $trimmed);

        if (!$isValid) {
            return [
                'status' => 'error',
                'message' => "Format invalid for {$config['name']}. Expected pattern: {$config['placeholder']}.",
            ];
        }

        return [
            'status' => 'success',
            'message' => "Verified! {$config['name']} credential format is 100% valid ({$trimmed}). Ready to receive telemetry events.",
        ];
    }
}
