<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <div>
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
        </div>
        <div class="header__menu">
            <nav>
                <ul>
                    <li><a href="#">自己紹介</a></li>
                    <li><a href="#">開発経験</a></li>
                    <li><a href="#">技術スタック</a></li>
                    <li><a href="#">ポートフォリオ</a></li>
                    <li><a href="#">ご依頼いただける仕事内容</a></li>
                    <li><a href="#">お問い合わせ</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <section name="introduction" class="bottom-hr">
        <code class="code">./profileInstall --profile=ishida-tomoya --mode=fullstack --lang=ja</code>
        <h1>ISHIDA<br />TOMOYA</h1>
        <code class="code">cat profile.txt</code>
        <ul>
            <li><span>役割:</span>フルスタックエンジニア（フリーランス）</li>
            <li><span>経験年数:</span>８年</li>
            <li><span>完遂案件数:</span></li>
            <li><span>使用経験技術:</span><span>React</span>, <span>Typescript</span>, <span>Vue.js</span>, <span>Node.js</span>, <span>Laravel</span></li>
            <li><span>稼働状況:</span>可能</li>
        </ul>
        <div class="flex">
            <button class="console_btn green">相談する</button>
            <button class="console_btn green">実績を見る</button>
        </div>
    </section>
    <section name="experience" class="bottom-hr">
        <code class="code">./load --section="experience"</code>
        <h1>開発経験</h1>
        <ul class="program-list">
            <li><label for="ex1-text">フロントエンド開発</label><span>8年</span>
                <p id="ex1-text">React/Next.jsを中心としたUI設計、パフォーマンス最適化まで一貫対応。また、Playwrightを用いたE2Eテスト、コンポーネントテスト自動化も経験。</p>
            </li>
            <li><label for="ex2-text">バックエンド開発</label><span>8年</span>
                <p id="ex2-text">Ruby on RailsやNode.js、Laravel、CakePHP、Djangoを用いたAPI設計、データベース設計、パフォーマンス最適化まで一貫対応。また、テスト自動化やCI/CDの導入も経験。</p>
            </li>
            <li><label for="ex3-text">インフラ保守</label><span>1年</span>
                <p id="ex3-text">AWSやGCPを用いたCI/CD・コンテナ化対応を経験。</p>
            </li>
        </ul>
    </section>

    <section name="tech-stack" class="bottom-hr">
        <code class="code">./load --section="tech-stack"</code>
        <h1>経験技術一覧</h1>
        <code>ls -la tech/</code>

        <div class="tech-stack__folders flex">
            <div>
                <code class="code">./フロントエンド:</code>
                <div class="flex">
                    <span>React</span>
                    <span>Typescript</span>
                    <span>JavaScript</span>
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>Sass/SCSS</span>
                    <span>Redux</span>
                    <span>Tailwind CSS</span>
                    <span>Material UI(MUI)</span>
                    <span>Bootstrap</span>
                    <span>Vite</span>
                    <span>ESBuild</span>
                </div>
            </div>
            <div>
                <code class="code">./バックエンド:</code>
                <div class="flex">
                    <span>Ruby on Rails</span>
                    <span>Laravel</span>
                    <span>ASP.NET Core MVC</span>
                    <span>Ruby</span>
                    <span>PHP</span>
                    <span>C#</span>
                    <span>Python</span>
                    <span>Sidekiq</span>
                    <span>Redis</span>
                </div>
            </div>
            <div>
                <code class="code">./データベース:</code>
                <div class="flex">
                    <span>MySQL</span>
                    <span>PostgreSQL</span>
                    <span>SQL Server</span>
                </div>
            </div>
            <div>
                <code class="code">./インフラ:</code>
                <div class="flex">
                    <span>AWS</span>
                    <span>GCP</span>
                    <span>Docker</span>
                    <span>Kubernetes</span>
                    <span>Nginx</span>
                    <span>IIS</span>
                    <span>Linux</span>
                    <span>Ubuntu</span>
                </div>
            </div>
            <div>
                <code class="code">./テスト:</code>
                <div class="flex">
                    <span>Playwright</span>
                    <span>Jest</span>
                    <span>Testing Library</span>
                    <span>Selenium</span>
                </div>
            </div>
        </div>
    </section>

    <section name="portfolio" class="bottom-hr">
        <code class="code">./load --section="portfolio"</code>
        <h1>ポートフォリオ</h1>
        <code class="code">cat project.log | head -10</code>
        <table>
            <tbody>
                <tr>
                    <td>[001]</td>
                    <td>
                        <div>
                            <h4 class="portfolio-title">PJタイトル</h4>
                            <span>PJ業務内容</span>
                        </div>
                    </td>
                    <td>実績内容</td>
                </tr>
        </table>
    </section>
    <section name="pricing" class="bottom-hr">
        <code class="code">./load --section="pricing"</code>
        <h1>パッケージ・料金</h1>
        <code class="code">cat pricing.json</code>
        <code class="code">{</code>
        <!-- TODO: 料金カードを作成。 -->
        <code class="code">}</code>
    </section>
    <section name="testimonials" class="bottom-hr">
        <code class="code">./load --section="testimonials"</code>
        <h1>お客様の声</h1>
        <ul class="program-list">
            <li>
                <code class="code">tail -l reviews/1.log</code>
                <p></p>
                <span></span>
            </li>
        </ul>
    </section>
    <section name="workflow" class="bottom-hr">
        <code class="code">./load --section="workflow"</code>
        <h1>開発プロセス</h1>
        <table>
            <tbody>
                <tr>
                    <td>01</td>
                    <td>
                        <div>
                            <h4 class="workflow-title">ワークフロー名</h4>
                            <span>補足情報</span>
                        </div>
                    </td>
                    <td>⇩</td>
                </tr>
            </tbody>
        </table>
    </section>
    <section name="faq" class="bottom-hr">
        <code class="code">./load --section="faq"</code>
        <h1>よくある質問</h1>
        <ul class="program-list">
            <li class="faq-item dropdown">
                どのような案件を受けていますか？
            </li>
        </ul>
    </section>

    <section name="blog" class="bottom-hr">
        <code class="code">curl https://info-space-box.net/</code>
        <h1>ブログ</h1>
        <!-- 本物ブログの一覧を埋め込む -->
    </section>
    <section name="contact" class="bottom-hr">
        <code class="code">./load --section="contact"</code>
        <h1>お問い合わせ</h1>
        <code class="code">./contact --send</code>
        <form action="/contact" method="POST">
            @csrf
            <label for="name">お名前:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">メッセージ:</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">送信</button>
        </form>
    </section>
    <footer class="top-hr">
        <div name="footer-logo">
            <img src="" alt="フッターロゴ">
        </div>
        <span name="copyright">© 2026 ISOMI HAYATO - ALL RIGHTS RESERVED</span>
    </footer>
</body>

</html>