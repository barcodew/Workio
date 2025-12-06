<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Page Not Found</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:300,500&display=swap" rel="stylesheet" />

    <style>
        /* Made with love by barcodew */

        html,
        body {
            width: 100%;
            height: 100%;
        }

        body {
            margin: 0;
            background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/257418/andy-holmes-698828-unsplash.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            min-height: 100vh;
            min-width: 100vw;
            font-family: "Roboto Mono", "Liberation Mono", Consolas, monospace;
            color: rgba(255, 255, 255, .87);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .container {
            width: 100%;
            max-width: 960px;
            padding: 16px;
        }

        .row {
            display: flex;
            justify-content: center;
        }

        .col {
            width: 100%;
            max-width: 600px;
        }

        #countUp {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            gap: .25rem;
            backdrop-filter: blur(2px);
        }

        #countUp .number {
            font-size: 4rem;
            font-weight: 500;
            line-height: 1;
        }

        #countUp .text {
            font-weight: 300;
        }

        #countUp .number+.text {
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container mx-auto">
        <div class="row">
            <div class="col">
                <div id="countUp">
                    <div class="number" data-count="404">0</div>
                    <div class="text">Page not found</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function formatThousandsNoRounding(n, dp = 0) {
            const neg = n < 0 ? '-' : '';
            const abs = Math.abs(n);
            const s = abs.toString();
            const parts = s.split('.');
            let intPart = parts[0];
            let fracPart = (parts[1] || '').slice(0, dp);

            let r = '';
            while (intPart.length > 3) {
                r = '.' + intPart.slice(-3) + r;
                intPart = intPart.slice(0, -3);
            }
            r = intPart + r;

            if (dp > 0) {
                while (fracPart.length < dp) fracPart += '0';
                return neg + r + ',' + fracPart;
            }
            return neg + r;
        }

        function animateCount(el, end, duration = 2000) {
            const start = 0;
            const startTime = performance.now();

            function tick(now) {
                const elapsed = now - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const current = Math.floor(start + (end - start) * progress);
                el.textContent = formatThousandsNoRounding(current);
                if (progress < 1) {
                    requestAnimationFrame(tick);
                } else {
                    el.textContent = formatThousandsNoRounding(end);
                }
            }

            requestAnimationFrame(tick);
        }

        (function initCountUp() {
            const numberEl = document.querySelector('#countUp .number');
            if (!numberEl) return;

            const target = parseInt(numberEl.getAttribute('data-count'), 10) || 0;
            let hasRun = false;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !hasRun) {
                        hasRun = true;
                        animateCount(numberEl, target, 2000);
                        observer.disconnect();
                    }
                });
            }, {
                threshold: 0.35
            });

            observer.observe(numberEl);
        })();
    </script>
</body>

</html>
