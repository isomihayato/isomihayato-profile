<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="フルスタックエンジニア ISHIDA TOMOYA のポートフォリオサイト">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=VT323&display=swap" rel="stylesheet">
    <title>ISHIDA TOMOYA — Fullstack Engineer</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="site">
    <header class="header">
        <a class="header__logo" href="#top"><span class="header__logo-text">ISOMI@DEV</span></a>
        <button class="header__toggle" type="button" aria-expanded="false" aria-controls="global-navigation">
            <span class="header__toggle-line"></span><span class="header__toggle-line"></span>
            <span class="header__toggle-label">MENU</span>
        </button>
        <nav class="header__nav" id="global-navigation" aria-label="メインナビゲーション">
            <a class="header__link" href="#works">実績</a>
            <a class="header__link" href="#skills">技術</a>
            <a class="header__link" href="#pricing">料金</a>
            <a class="header__link" href="#contact">連絡</a>
            <a class="header__link header__link--accent" href="#contact">相談する →</a>
        </nav>
    </header>

    <main>
        <section class="hero" id="top">
            <div class="hero__main">
                <p class="terminal-command">$ ./profileInstall --profile=ishida-tomoya --mode=fullstack --lang=ja</p>
                <h1 class="hero__title vt323-regular">ISHIDA<br>TOMOYA</h1>
                <div class="hero__profile">
                    <p class="terminal-command">$ cat profile.txt</p>
                    <dl class="hero__details">
                        <div>
                            <dt>役割:</dt>
                            <dd>フルスタックエンジニア (フリーランス)</dd>
                        </div>
                        <div>
                            <dt>経験年数:</dt>
                            <dd>8 年</dd>
                        </div>
                        <div>
                            <dt>完遂案件数:</dt>
                            <dd>20+ 件</dd>
                        </div>
                        <div>
                            <dt>使用経験技術:</dt>
                            <dd>React, TypeScript, Laravel, AWS など</dd>
                        </div>
                        <div>
                            <dt>稼働可否:</dt>
                            <dd><mark>可能</mark></dd>
                        </div>
                    </dl>
                </div>
                <div class="hero__actions">
                    <a class="button button--terminal" href="#contact">>_ 相談する</a>
                    <a class="button button--terminal" href="#works">>_ 実績を見る</a>
                </div>
            </div>
        </section>

        <section class="experience section" id="experience">
            <div class="section__heading">
                <p class="terminal-command">$ ./load --section="experience"</p>
                <h2 class="section__title">開発経験</h2>
            </div>
            <div class="experience__grid">
                <article class="experience__card">
                    <div class="experience__meta"><span>フロントエンド開発</span><strong>8年</strong></div>
                    <p>React / Next.jsを中心としたUI設計・実装。パフォーマンス最適化、E2Eテストまで一貫対応。</p>
                </article>
                <article class="experience__card experience__card--dark">
                    <div class="experience__meta"><span>バックエンド開発</span><strong>8年</strong></div>
                    <p>Laravel / Rails / Node.jsによるAPI・DB設計。保守性の高い業務システム構築が得意。</p>
                </article>
                <article class="experience__card experience__card--accent">
                    <div class="experience__meta"><span>クラウド / インフラ</span><strong>1年</strong></div>
                    <p>AWS / GCPを活用したCI/CD・コンテナ化。運用を見据えた環境構築に対応。</p>
                </article>
            </div>
        </section>

        <section class="works section section--bordered" id="works">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="portfolio"</p>
                <h2 class="section__title">ポートフォリオ</h2>
            </header>
            <p class="terminal-command">$ cat projects.log | head -10</p>
            <div class="works__list">
                <article class="works__item"><span class="works__number">001</span>
                    <div class="works__content">
                        <h3 class="works__title">Webサービス開発・改善</h3>
                        <p class="works__description">Laravel / React　設計・実装・運用</p>
                    </div><time class="works__year">2025</time><strong class="works__result">継続改善</strong>
                </article>
                <article class="works__item works__item--accent"><span class="works__number">002</span>
                    <div class="works__content">
                        <h3 class="works__title">業務システム刷新</h3>
                        <p class="works__description">要件整理からリリースまで一貫対応</p>
                    </div><time class="works__year">2024</time><strong class="works__result">工数削減</strong>
                </article>
                <article class="works__item"><span class="works__number">003</span>
                    <div class="works__content">
                        <h3 class="works__title">テスト自動化基盤</h3>
                        <p class="works__description">Playwright E2E / CI連携</p>
                    </div><time class="works__year">2024</time><strong class="works__result">品質向上</strong>
                </article>
                <article class="works__item works__item--dark"><span class="works__number">004</span>
                    <div class="works__content">
                        <h3 class="works__title">クラウド環境構築</h3>
                        <p class="works__description">AWS × Docker × CI/CD</p>
                    </div><time class="works__year">2023</time><strong class="works__result">運用最適化</strong>
                </article>
            </div>
        </section>

        <section class="skills section section--bordered" id="skills">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="tech-stack"</p>
                <h2 class="section__title">経験技術</h2>
            </header>
            <p class="terminal-command">$ ls -la tech/</p>
            <div class="skills__grid">
                @foreach ([
                ['FRONTEND', ['React', 'TypeScript', 'Next.js', 'Vue.js', 'Sass / SCSS']],
                ['BACKEND', ['Laravel', 'Ruby on Rails', 'Node.js', 'PHP', 'Python']],
                ['INFRA', ['AWS', 'GCP', 'Docker', 'Kubernetes', 'Nginx']],
                ['DB / TEST', ['MySQL', 'PostgreSQL', 'Redis', 'Playwright', 'Jest']],
                ] as [$category, $items])
                <div class="skills__group">
                    <h3 class="skills__category">{{ $category }}</h3>
                    <ul class="skills__list">@foreach ($items as $item)<li class="skills__item">{{ $item }}</li>@endforeach</ul>
                </div>
                @endforeach
            </div>
        </section>

        <section class="pricing section section--bordered" id="pricing">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="pricing"</p>
                <h2 class="section__title">パッケージ・料金</h2>
            </header>
            <p class="terminal-command">$ cat pricing.json</p>
            <div class="pricing__grid">
                <article class="pricing__card">
                    <p class="pricing__name">STARTER</p>
                    <p class="pricing__price">¥300,000–</p>
                    <p class="pricing__lead">LP / 静的サイト制作</p>
                    <ul class="pricing__features">
                        <li>レスポンシブデザイン</li>
                        <li>基本SEO対応</li>
                        <li>1ヶ月サポート</li>
                    </ul><a class="button button--outline" href="#contact">相談する</a>
                </article>
                <article class="pricing__card pricing__card--accent"><span class="pricing__badge">HOT</span>
                    <p class="pricing__name">STANDARD</p>
                    <p class="pricing__price">¥800,000–</p>
                    <p class="pricing__lead">Webアプリ開発</p>
                    <ul class="pricing__features">
                        <li>API・DB設計</li>
                        <li>テスト実装</li>
                        <li>3ヶ月サポート</li>
                        <li>コードレビュー</li>
                    </ul><a class="button button--dark" href="#contact">相談する</a>
                </article>
                <article class="pricing__card">
                    <p class="pricing__name">ENTERPRISE</p>
                    <p class="pricing__price">要相談</p>
                    <p class="pricing__lead">大規模システム開発</p>
                    <ul class="pricing__features">
                        <li>アーキテクチャ設計</li>
                        <li>チーム支援</li>
                        <li>長期サポート</li>
                        <li>運用改善</li>
                    </ul><a class="button button--outline" href="#contact">相談する</a>
                </article>
            </div>
        </section>

        <section class="testimonials section section--dark" id="testimonials">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="testimonials"</p>
                <h2 class="section__title">お客様の声</h2>
            </header>
            <div class="testimonials__grid">
                <figure class="testimonials__card">
                    <div class="testimonials__stars">★★★★★</div>
                    <blockquote>“要件の理解が早く、品質とスピードの両方で期待を超える成果でした。”</blockquote>
                    <figcaption>プロジェクト責任者<br><span>WEB SERVICE</span></figcaption>
                </figure>
                <figure class="testimonials__card">
                    <div class="testimonials__stars">★★★★★</div>
                    <blockquote>“技術的な選択肢を分かりやすく説明し、最適な方法を一緒に考えてくれました。”</blockquote>
                    <figcaption>事業責任者<br><span>STARTUP</span></figcaption>
                </figure>
                <figure class="testimonials__card">
                    <div class="testimonials__stars">★★★★★</div>
                    <blockquote>“リリース後の改善まで伴走してもらい、安心してプロジェクトを進められました。”</blockquote>
                    <figcaption>開発マネージャー<br><span>SYSTEM DEVELOPMENT</span></figcaption>
                </figure>
            </div>
        </section>

        <section class="process section section--bordered" id="process">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="process"</p>
                <h2 class="section__title">開発の流れ</h2>
            </header>
            <p class="terminal-command">$ ./workflow --show-steps</p>
            <ol class="process__list">
                @foreach ([['DISCOVERY','ヒアリング','目標・課題・予算をオンラインMTGで丁寧に確認'],['PROPOSAL','要件定義・提案','技術選定・スコープ・スケジュール・見積もりを文書化'],['BUILD','設計・開発','進捗を共有しながら透明性を保って開発'],['LAUNCH','テスト・リリース','品質チェック・動作確認後、本番環境へデプロイ'],['SUPPORT','サポート・保守','リリース後も改善・ご質問対応を継続']] as $step)
                <li class="process__item"><span class="process__number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    <div>
                        <p class="process__label">{{ $step[0] }}</p>
                        <h3 class="process__title">{{ $step[1] }}</h3>
                        <p class="process__description">{{ $step[2] }}</p>
                    </div>
                </li>
                @endforeach
            </ol>
        </section>

        <section class="faq section section--bordered" id="faq">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="faq"</p>
                <h2 class="section__title">よくある質問</h2>
            </header>
            <div class="faq__list">
                @foreach ([
                ['どのような案件を受けていますか？','Webアプリケーション開発、既存システムの改善、テスト自動化、技術支援などに対応しています。'],
                ['対応可能な稼働量はどのくらいですか？','案件内容と時期により調整します。まずはご希望の期間・稼働量をお知らせください。'],
                ['支払いはどのように行いますか？','着手前に条件をご相談し、契約内容に沿って請求書を発行します。'],
                ['リモートワークのみですか？','基本はリモートですが、場所や頻度によっては対面での打ち合わせも可能です。'],
                ] as [$question, $answer])
                <div class="faq__item"><button class="faq__question" type="button" aria-expanded="false"><span>Q. {{ $question }}</span><span class="faq__icon">+</span></button>
                    <div class="faq__answer" hidden>
                        <p>{{ $answer }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section class="blog section section--bordered" id="blog">
            <header class="section__heading">
                <p class="terminal-command">$ ./load --section="blog"</p>
                <h2 class="section__title">ブログ</h2>
            </header>
            <p class="terminal-command">$ ls -lt articles/</p>
            <div class="blog__list">
                <a class="blog__item" href="https://info-space-box.net/" target="_blank" rel="noopener"><span class="blog__number">01</span><span class="blog__tag">ENGINEERING</span><strong class="blog__title">技術ブログを読む</strong><span class="blog__date">INFO-SPACE-BOX.NET</span></a>
            </div>
        </section>

        <section class="contact section" id="contact">
            <div class="contact__info">
                <p class="terminal-command">$ ./load --section="contact"</p>
                <h2 class="section__title">お問い合わせ</h2>
                <p class="terminal-command">$ ./contact --send</p>
                <p class="contact__lead">案件のご相談、お見積もり、技術的なご質問など、お気軽にどうぞ。通常2営業日以内にご返信します。</p>
                <dl class="contact__details">
                    <div>
                        <dt>email:</dt>
                        <dd>お問い合わせフォームよりご連絡ください</dd>
                    </div>
                    <div>
                        <dt>area:</dt>
                        <dd>REMOTE / JAPAN</dd>
                    </div>
                </dl>
            </div>
            <form class="contact__form" action="/contact" method="POST">@csrf
                <label class="contact__field"><span>お名前</span><input class="contact__input" type="text" name="name" required></label>
                <label class="contact__field"><span>メールアドレス</span><input class="contact__input" type="email" name="email" required></label>
                <label class="contact__field"><span>件名</span><input class="contact__input" type="text" name="subject"></label>
                <label class="contact__field"><span>メッセージ</span><textarea class="contact__input contact__input--textarea" name="message" required></textarea></label>
                <button class="button button--dark contact__submit" type="submit">送信する →</button>
            </form>
        </section>
    </main>

    <footer class="footer"><a class="footer__logo" href="#top">ISOMI@DEV</a><span class="footer__copyright">© 2026 ISHIDA TOMOYA</span></footer>
</body>

</html>