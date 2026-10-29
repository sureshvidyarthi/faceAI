<?php
$pageTitle = "FaceAI Studio";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#f3f5fa">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>

    <script defer src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

    <style>
        :root {
            color-scheme: light;
            --bg: #f3f5fa;
            --panel: #fff;
            --line: #e5e9f2;
            --text: #172238;
            --muted: #77839a;
            --blue: #377df6;
            --violet: #7468ef;
            --green: #169c72;
            --pink: #e75c91;
            --amber: #d99124;
            --radius: 18px;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--text);
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(ellipse at 0% 0%, rgba(55, 125, 246, .07), transparent 30%),
                radial-gradient(ellipse at 100% 0%, rgba(116, 104, 239, .06), transparent 28%),
                var(--bg);
        }

        button {
            font: inherit
        }

        .topbar {
            height: 72px;
            padding: 0 clamp(18px, 4vw, 58px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid #e6eaf2;
            background: rgba(255, 255, 255, .92);
            box-shadow: 0 3px 14px #1d2b4a05;
            backdrop-filter: blur(18px);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 19px;
            font-weight: 850;
            letter-spacing: -.8px;
            color: #172238;
        }

        .brand-mark {
            width: 36px;
            height: 36px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            background: linear-gradient(140deg, #377df6, #7468ef);
            color: white;
            box-shadow: 0 6px 15px #377df626;
            font-size: 20px;
        }

        .brand small {
            display: block;
            font-size: 9px;
            color: #8792a7;
            font-weight: 700;
            letter-spacing: 1.8px;
            margin-top: 2px;
        }

        .brand-name span {
            color: var(--blue)
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .top-chip {
            display: flex;
            align-items: center;
            gap: 8px;
            border: 1px solid #e4e9f3;
            background: #f8faff;
            border-radius: 30px;
            padding: 9px 13px;
            color: #63718b;
            font-size: 10px;
            font-weight: 750;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #aab4c6;
            display: inline-block;
            flex-shrink: 0;
        }

        .status-dot.live {
            background: var(--green);
            box-shadow: 0 0 0 4px #169c7216;
        }

        main {
            max-width: 1480px;
            margin: auto;
            padding: 30px clamp(16px, 4vw, 58px) 55px;
        }

        .hero {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 22px;
            margin-bottom: 23px;
        }

        .kicker {
            font-size: 10px;
            color: var(--blue);
            font-weight: 850;
            letter-spacing: 2.1px;
            text-transform: uppercase;
        }

        h1 {
            color: #172238;
            font-size: clamp(30px, 3.8vw, 43px);
            line-height: 1.08;
            letter-spacing: -2px;
            margin: 10px 0;
        }

        h1 .gradient {
            background: linear-gradient(90deg, #377df6, #7468ef);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .hero p {
            margin: 0;
            max-width: 650px;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.8;
        }

        .hero-tag {
            white-space: nowrap;
            border: 1px solid #dce6ff;
            background: #edf3ff;
            color: #3468cb;
            padding: 10px 12px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: 800;
        }

        .top-workspace {
            display: grid;
            grid-template-columns: minmax(0, 1.48fr) minmax(340px, .82fr);
            gap: 18px;
            align-items: stretch;
            margin-bottom: 18px;
        }

        .camera-column,
        .analytics-column {
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .panel {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 5px 18px rgba(28, 43, 75, .035);
            min-width: 0;
        }

        .camera-panel,
        .analytics-panel {
            height: 100%
        }

        .panel-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 16px 19px;
            border-bottom: 1px solid #edf0f6;
        }

        .panel-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 12px;
            font-weight: 800;
            color: #1b2942;
        }

        .panel-icon {
            display: grid;
            place-items: center;
            width: 31px;
            height: 31px;
            flex-shrink: 0;
            border: 1px solid #e2eaff;
            border-radius: 9px;
            color: var(--blue);
            background: #eff4ff;
            font-size: 17px;
        }

        .panel-sub {
            font-size: 10px;
            color: #8792a7;
            margin-top: 3px;
            font-weight: 500;
        }

        .live-label {
            font-size: 9px;
            letter-spacing: .7px;
            font-weight: 800;
            color: #6e7d96;
            display: flex;
            align-items: center;
            gap: 7px;
            white-space: nowrap;
        }

        .camera-stage {
            position: relative;
            aspect-ratio: 16/10;
            min-height: 360px;
            background: radial-gradient(ellipse at center, #17253a, #080d16 76%);
            overflow: hidden;
            border-bottom: 1px solid #e9edf4;
        }

        .camera-stage:before {
            content: "";
            position: absolute;
            inset: 15px;
            border: 1px solid #8eb8ff28;
            border-radius: 13px;
            pointer-events: none;
            z-index: 2;
        }

        .corner {
            position: absolute;
            width: 21px;
            height: 21px;
            border-color: #74a5ff;
            border-style: solid;
            opacity: .85;
            z-index: 3;
            pointer-events: none;
        }

        .corner.tl {
            top: 14px;
            left: 14px;
            border-width: 2px 0 0 2px;
            border-radius: 5px 0 0;
        }

        .corner.tr {
            top: 14px;
            right: 14px;
            border-width: 2px 2px 0 0;
            border-radius: 0 5px 0 0;
        }

        .corner.bl {
            bottom: 14px;
            left: 14px;
            border-width: 0 0 2px 2px;
            border-radius: 0 0 0 5px;
        }

        .corner.br {
            bottom: 14px;
            right: 14px;
            border-width: 0 2px 2px 0;
            border-radius: 0 0 5px;
        }

        #video {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: contain;
            transform: scaleX(-1);
        }

        #overlay {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            transform: scaleX(-1);
        }

        .camera-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 25px;
            z-index: 1;
        }

        .placeholder-inner {
            max-width: 310px
        }

        .camera-orb {
            width: 76px;
            height: 76px;
            margin: 0 auto 19px;
            border-radius: 25px;
            display: grid;
            place-items: center;
            font-size: 30px;
            color: #8bb6ff;
            border: 1px solid #74a5ff38;
            background: linear-gradient(145deg, #377df62b, #7468ef25);
            box-shadow: 0 0 60px #377df51a;
        }

        .camera-placeholder strong {
            display: block;
            color: #f2f6ff;
            font-size: 17px;
        }

        .camera-placeholder p {
            font-size: 12px;
            line-height: 1.7;
            color: #9ba9c1;
            margin: 8px 0 0;
        }

        .stage-footer {
            position: absolute;
            left: 25px;
            right: 25px;
            bottom: 23px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            align-items: center;
            z-index: 4;
            pointer-events: none;
        }

        .stage-chip {
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .5px;
            color: #e5edff;
            background: #111a2acb;
            border: 1px solid #ffffff1b;
            border-radius: 7px;
            padding: 8px 10px;
            backdrop-filter: blur(8px);
        }

        .controls {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            padding: 14px 17px;
        }

        .btn {
            border: 1px solid #e1e7f0;
            border-radius: 9px;
            padding: 10px 13px;
            background: #fff;
            color: #3d4b63;
            font-size: 11px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .18s, border-color .18s, background .18s;
        }

        .btn:hover {
            transform: translateY(-1px);
            background: #f7f9ff;
            border-color: #b7caff;
        }

        .btn:disabled {
            opacity: .4;
            cursor: not-allowed;
            transform: none;
        }

        .btn-primary {
            color: white;
            border: 0;
            background: linear-gradient(105deg, #377df6, #7468ef);
            box-shadow: 0 5px 13px #377df626;
        }

        .btn-primary:hover {
            border: 0;
            color: white;
            background: linear-gradient(105deg, #2869df, #6254dc);
        }

        .controls-note {
            margin-left: auto;
            color: #8a95a8;
            font-size: 10px;
        }

        .panel-body {
            padding: 19px 21px
        }

        .analytics-panel .panel-body {
            padding: 16px 17px
        }

        .expression-overview {
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px;
            border: 1px solid #e6ebfa;
            border-radius: 14px;
            background: linear-gradient(115deg, #f4f8ff, #f8f7ff);
            margin-bottom: 16px;
        }

        .expression-face {
            width: 52px;
            height: 52px;
            flex: 0 0 52px;
            display: grid;
            place-items: center;
            font-size: 26px;
            border-radius: 14px;
            background: #fff;
            border: 1px solid #e7ecf5;
        }

        .expression-info {
            min-width: 0;
            flex: 1;
        }

        .expression-name {
            font-size: 22px;
            font-weight: 850;
            letter-spacing: -.6px;
            color: #18243a;
        }

        .expression-caption {
            font-size: 10px;
            color: #7c879b;
            margin-top: 4px;
            line-height: 1.5;
        }

        .score-ring {
            --score: 0deg;
            width: 57px;
            height: 57px;
            flex: 0 0 57px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: conic-gradient(#377df6 var(--score), #e6ebf4 0);
            position: relative;
        }

        .score-ring:before {
            content: "";
            position: absolute;
            inset: 5px;
            border-radius: 50%;
            background: #fff;
        }

        .score-ring span {
            position: relative;
            font-size: 11px;
            font-weight: 850;
            color: #26344d;
        }

        .chart-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin: 0 0 12px;
            font-size: 11px;
            font-weight: 800;
            color: #26344d;
        }

        .chart-heading span {
            color: #8b95a8;
            font-size: 10px;
            font-weight: 600;
            white-space: nowrap;
        }

        .emotion-row {
            display: grid;
            grid-template-columns: 77px minmax(35px, 1fr) 40px;
            align-items: center;
            gap: 8px;
            margin: 11px 0;
        }

        .emotion-label {
            font-size: 10px;
            color: #475570;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .emotion-label .emoji {
            font-size: 15px
        }

        .bar-track {
            height: 7px;
            border-radius: 20px;
            background: #edf1f7;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            width: 0;
            border-radius: 20px;
            transition: width .35s ease;
        }

        .emotion-pct {
            text-align: right;
            font-size: 10px;
            color: #758199;
            font-variant-numeric: tabular-nums;
        }

        .chart-divider {
            height: 1px;
            background: #edf0f6;
            margin: 18px 0;
        }

        .chart-canvas-wrap {
            height: 125px;
            position: relative;
        }

        #timeline {
            width: 100%;
            height: 100%;
            display: block;
        }

        .chart-legend {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            font-size: 10px;
            color: #77839a;
            margin-top: 8px;
        }

        .legend-dot {
            display: inline-block;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 13px;
            margin: 0 0 18px;
        }

        .stat {
            position: relative;
            overflow: hidden;
            padding: 16px 18px;
            border: 1px solid #e5e9f2;
            border-radius: 15px;
            background: #fff;
            box-shadow: 0 5px 18px rgba(28, 43, 75, .035);
            min-height: 105px;
        }

        .stat:after {
            content: "";
            position: absolute;
            width: 82px;
            height: 82px;
            right: -30px;
            top: -34px;
            border-radius: 50%;
            background: var(--glow, #377df610);
            filter: blur(9px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: #7d899e;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: .25px;
            gap: 6px;
        }

        .stat-icon {
            width: 29px;
            height: 29px;
            flex-shrink: 0;
            border-radius: 9px;
            display: grid;
            place-items: center;
            background: #f1f5ff;
            color: var(--accent, #377df6);
            border: 1px solid #e7edfb;
            font-size: 15px;
        }

        .stat-value {
            font-size: 29px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: -1px;
            margin-top: 12px;
            position: relative;
            z-index: 1;
            color: #172238;
            font-variant-numeric: tabular-nums;
        }

        .stat-value small {
            font-size: 11px;
            letter-spacing: 0;
            color: #8792a7;
            font-weight: 600;
        }

        .stat-foot {
            font-size: 10px;
            color: #8b96a9;
            margin-top: 7px;
        }

        .lower-workspace {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr) minmax(230px, .85fr);
            gap: 15px;
            align-items: stretch;
        }

        .lower-workspace>div {
            min-width: 0
        }

        .face-list {
            display: flex;
            flex-direction: column;
            gap: 9px;
        }

        .face-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px;
            border: 1px solid #e9edf5;
            border-radius: 11px;
            background: #fbfcff;
            min-width: 0;
        }

        .face-avatar {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            background: #edf3ff;
            display: grid;
            place-items: center;
            color: #377df6;
            font-size: 13px;
            font-weight: 850;
            flex: 0 0 auto;
        }

        .face-meta {
            flex: 1;
            min-width: 0;
        }

        .face-title {
            font-size: 12px;
            font-weight: 800;
            color: #26344d;
        }

        .face-detail {
            font-size: 10px;
            color: #8a95a8;
            margin-top: 4px;
            line-height: 1.5;
        }

        .face-emotion {
            font-size: 11px;
            font-weight: 800;
            text-align: right;
            color: #34425b;
            flex-shrink: 0;
        }

        .empty-state {
            text-align: center;
            color: #8994a8;
            font-size: 12px;
            line-height: 1.8;
            padding: 19px 8px;
        }

        .empty-state .empty-icon {
            font-size: 25px;
            margin-bottom: 5px;
            opacity: .8;
        }

        .privacy {
            display: flex;
            gap: 12px;
            padding: 15px 17px;
            border: 1px solid #d8f1e5;
            background: #f0fbf6;
            border-radius: 13px;
            color: #71877f;
            font-size: 11px;
            line-height: 1.8;
            height: 100%;
        }

        .privacy-icon {
            color: var(--green);
            font-size: 17px;
            flex-shrink: 0;
        }

        .privacy strong {
            color: #16855f
        }

        footer {
            padding: 22px;
            text-align: center;
            font-size: 10px;
            color: #8d98aa;
            border-top: 1px solid #e5e9f2;
            letter-spacing: .4px;
        }

        @media(max-width:1120px) {
            .top-workspace {
                grid-template-columns: minmax(0, 1.2fr) minmax(300px, .9fr);
            }

            .camera-stage {
                min-height: 310px
            }

            .lower-workspace {
                grid-template-columns: 1fr 1fr
            }

            .lower-privacy {
                grid-column: 1/-1
            }
        }

        @media(max-width:850px) {
            main {
                padding-top: 23px
            }

            .top-workspace {
                grid-template-columns: 1fr
            }

            .camera-stage {
                aspect-ratio: 16/10;
                min-height: 280px;
            }

            .lower-workspace {
                grid-template-columns: 1fr 1fr
            }

            .lower-privacy {
                grid-column: 1/-1
            }

            .analytics-panel .panel-body {
                padding: 17px
            }
        }

        @media(max-width:680px) {
            .topbar {
                height: 64px;
                padding: 0 15px;
            }

            .brand {
                font-size: 17px;
                gap: 9px
            }

            .brand-mark {
                width: 33px;
                height: 33px;
            }

            .brand small {
                font-size: 8px;
                letter-spacing: 1.3px;
            }

            .top-chip {
                padding: 8px 10px;
                font-size: 9px;
            }

            .top-chip.hide-mobile {
                display: none
            }

            main {
                padding: 23px 13px 35px
            }

            .hero {
                display: block;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 33px;
                letter-spacing: -1.6px;
            }

            .hero p {
                font-size: 12px
            }

            .hero-tag {
                display: inline-block;
                margin-top: 14px;
                white-space: normal;
            }

            .top-workspace {
                gap: 14px
            }

            .camera-stage {
                aspect-ratio: 4/3;
                min-height: 235px;
            }

            .panel-head {
                padding: 14px
            }

            .panel-title {
                font-size: 11px
            }

            .panel-icon {
                width: 29px;
                height: 29px;
            }

            .live-label {
                font-size: 8px
            }

            .controls {
                padding: 13px;
                gap: 8px
            }

            .btn {
                padding: 10px 11px;
                font-size: 10px;
            }

            .controls-note {
                width: 100%;
                margin: 2px 0 0;
                line-height: 1.6;
            }

            .stage-footer {
                left: 18px;
                right: 18px;
                bottom: 18px;
            }

            .stage-chip {
                font-size: 8px;
                padding: 7px;
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 9px;
            }

            .stat {
                min-height: 100px;
                padding: 13px;
            }

            .stat-top {
                font-size: 9px
            }

            .stat-value {
                font-size: 25px
            }

            .lower-workspace {
                grid-template-columns: 1fr
            }

            .lower-privacy {
                grid-column: auto
            }

            .analytics-panel .panel-body {
                padding: 14px
            }

            .expression-overview {
                padding: 11px;
                gap: 9px;
            }

            .expression-face {
                width: 46px;
                height: 46px;
                flex-basis: 46px;
                font-size: 23px;
            }

            .expression-name {
                font-size: 19px
            }

            .score-ring {
                width: 49px;
                height: 49px;
                flex-basis: 49px;
            }

            .emotion-row {
                grid-template-columns: 75px minmax(35px, 1fr) 39px;
                gap: 7px;
            }

            .chart-heading {
                font-size: 10px
            }

            .chart-heading span {
                font-size: 9px
            }

            .chart-legend {
                gap: 10px;
                font-size: 9px
            }

            footer {
                padding: 18px 12px;
                line-height: 1.8;
            }
        }

        [hidden] {
            display: none !important
        }
    </style>
</head>

<body>
    <header class="topbar">
        <div class="brand">
            <div class="brand-mark">◈</div>
            <div class="brand-name">
                Face<span>AI</span> Studio
                <small>VISION INTELLIGENCE</small>
            </div>
        </div>

        <div class="top-right">
            <div class="top-chip">
                <i class="status-dot" id="liveDot"></i>
                <span id="status">SYSTEM STANDBY</span>
            </div>
            <div class="top-chip hide-mobile">● LOCAL PROCESSING</div>
        </div>
    </header>

    <main>
        <section class="hero">
            <div>
                <div class="kicker">Computer vision / live analytics</div>
                <h1>Understand the <span class="gradient">expression.</span></h1>
                <p>
                    Real-time face detection with facial-expression estimates,
                    visual analytics and live session metrics — all inside your browser.
                </p>
            </div>
            <div class="hero-tag">✦ &nbsp; AI ANALYSIS WORKSPACE</div>
        </section>

        <section class="top-workspace">
            <div class="camera-column">
                <div class="panel camera-panel">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-icon">⌗</span>
                            <div>
                                Live camera feed
                                <div class="panel-sub">Face bounding boxes & expression labels</div>
                            </div>
                        </div>
                        <div class="live-label">
                            <i class="status-dot" id="feedDot"></i>
                            <span id="feedStatus">AWAITING CAMERA</span>
                        </div>
                    </div>

                    <div class="camera-stage" id="stage">
                        <video id="video" autoplay muted playsinline hidden></video>
                        <canvas id="overlay"></canvas>

                        <div class="camera-placeholder" id="placeholder">
                            <div class="placeholder-inner">
                                <div class="camera-orb">⌁</div>
                                <strong id="placeholderTitle">Your vision workspace</strong>
                                <p id="placeholderText">
                                    Activate your camera to start real-time face and expression analysis.
                                </p>
                            </div>
                        </div>

                        <i class="corner tl"></i>
                        <i class="corner tr"></i>
                        <i class="corner bl"></i>
                        <i class="corner br"></i>

                        <div class="stage-footer">
                            <span class="stage-chip" id="resolution">INPUT · CAMERA</span>
                            <span class="stage-chip">LIVE DETECTION OVERLAY</span>
                        </div>
                    </div>

                    <div class="controls">
                        <button class="btn btn-primary" id="startBtn">▶ &nbsp; Start camera</button>
                        <button class="btn" id="stopBtn" disabled>■ &nbsp; Stop session</button>
                        <button class="btn" id="resetBtn">↻ &nbsp; Reset analytics</button>
                        <span class="controls-note">Camera permission required · No video recording</span>
                    </div>
                </div>
            </div>

            <div class="analytics-column">
                <div class="panel analytics-panel">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-icon">⌁</span>
                            <div>
                                Expression analytics
                                <div class="panel-sub">Latest detected face · model score distribution</div>
                            </div>
                        </div>
                        <span class="live-label">7 EXPRESSIONS</span>
                    </div>

                    <div class="panel-body">
                        <div class="expression-overview">
                            <div class="expression-face" id="emotionIcon">◎</div>
                            <div class="expression-info">
                                <div class="expression-name" id="emotionName">Awaiting face</div>
                                <div class="expression-caption" id="confidence">
                                    Start the camera to analyze facial expressions.
                                </div>
                            </div>
                            <div class="score-ring" id="scoreRing">
                                <span id="scoreValue">—</span>
                            </div>
                        </div>

                        <div class="chart-heading">
                            Expression score breakdown
                            <span>Current frame</span>
                        </div>

                        <div id="bars">
                            <div class="empty-state">
                                <div class="empty-icon">▥</div>
                                Expression scores will appear here after a face is detected.
                            </div>
                        </div>

                        <div class="chart-divider"></div>

                        <div class="chart-heading">
                            Session trend
                            <span>Recent samples</span>
                        </div>

                        <div class="chart-canvas-wrap">
                            <canvas id="timeline"></canvas>
                        </div>

                        <div class="chart-legend">
                            <span><i class="legend-dot" style="background:#377df6"></i>Happy score</span>
                            <span><i class="legend-dot" style="background:#7468ef"></i>Neutral score</span>
                            <span><i class="legend-dot" style="background:#e75c91"></i>Sad score</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats">
            <div class="stat" style="--accent:#377df6;--glow:#377df61a">
                <div class="stat-top">
                    <span>FACES IN FRAME</span>
                    <span class="stat-icon">◎</span>
                </div>
                <div class="stat-value" id="faceCount">0</div>
                <div class="stat-foot">Currently detected</div>
            </div>

            <div class="stat" style="--accent:#7468ef;--glow:#7468ef1a">
                <div class="stat-top">
                    <span>PROCESSING SPEED</span>
                    <span class="stat-icon">ϟ</span>
                </div>
                <div class="stat-value"><span id="fps">0</span> <small>FPS</small></div>
                <div class="stat-foot">Approx. analysis rate</div>
            </div>

            <div class="stat" style="--accent:#169c72;--glow:#169c7216">
                <div class="stat-top">
                    <span>FRAMES ANALYZED</span>
                    <span class="stat-icon">▦</span>
                </div>
                <div class="stat-value" id="frames">0</div>
                <div class="stat-foot">This session</div>
            </div>

            <div class="stat" style="--accent:#d99124;--glow:#d9912416">
                <div class="stat-top">
                    <span>SESSION TIME</span>
                    <span class="stat-icon">◷</span>
                </div>
                <div class="stat-value" id="sessionTime">00:00</div>
                <div class="stat-foot">Camera active duration</div>
            </div>
        </section>

        <section class="lower-workspace">
            <div class="lower-faces">
                <div class="panel">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-icon">◎</span>
                            <div>
                                Detected faces
                                <div class="panel-sub">Per-face detection summary</div>
                            </div>
                        </div>
                        <span class="live-label" id="faceSummary">0 TRACKED</span>
                    </div>

                    <div class="panel-body">
                        <div class="face-list" id="faceList">
                            <div class="empty-state">
                                <div class="empty-icon">◉</div>
                                No faces detected yet.<br>
                                Move into the camera frame to begin.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lower-system">
                <div class="panel">
                    <div class="panel-head">
                        <div class="panel-title">
                            <span class="panel-icon">◌</span>
                            <div>
                                System status
                                <div class="panel-sub">Runtime and model information</div>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="face-card">
                            <div class="face-avatar">AI</div>
                            <div class="face-meta">
                                <div class="face-title">Detection model</div>
                                <div class="face-detail" id="modelStatus">Not loaded</div>
                            </div>
                            <div class="face-emotion" id="modelBadge" style="color:var(--muted)">IDLE</div>
                        </div>

                        <div class="face-card">
                            <div class="face-avatar">⌘</div>
                            <div class="face-meta">
                                <div class="face-title">Processing mode</div>
                                <div class="face-detail">Browser-side inference</div>
                            </div>
                            <div class="face-emotion" style="color:var(--green)">LOCAL</div>
                        </div>

                        <div class="face-card">
                            <div class="face-avatar">↗</div>
                            <div class="face-meta">
                                <div class="face-title">Camera resolution</div>
                                <div class="face-detail" id="resolutionDetail">Waiting for camera</div>
                            </div>
                            <div class="face-emotion" id="resolutionBadge" style="color:var(--muted)">—</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lower-privacy">
                <div class="privacy">
                    <div class="privacy-icon">◇</div>
                    <div>
                        <strong>Privacy by design</strong><br>
                        Video frames are processed in your browser and are not uploaded or
                        recorded by this demo. The AI model files are downloaded from a CDN.
                        Expression scores are estimates, not proof of a person's internal
                        emotional state.
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        FACEAI STUDIO &nbsp;·&nbsp; EXPERIMENTAL COMPUTER VISION
        &nbsp;·&nbsp; BUILT FOR BROWSER-BASED ANALYSIS
    </footer>

    <script>
        (() => {
            "use strict";

            const $ = id => document.getElementById(id);

            const video = $("video");
            const overlay = $("overlay");
            const ctx = overlay.getContext("2d");
            const timeline = $("timeline");
            const tctx = timeline.getContext("2d");

            const MODEL_URL =
                "https://cdn.jsdelivr.net/gh/justadudewhojak/face-api.js@0.22.2/weights";

            // Correct model repository path

            const MODEL_PATH =
                "https://cdn.jsdelivr.net/gh/justadudewhohacks/face-api.js@0.22.2/weights";


            const expressions = [{
                    key: "happy",
                    label: "Happy",
                    icon: "😊"
                },
                {
                    key: "sad",
                    label: "Sad",
                    icon: "😢"
                },
                {
                    key: "angry",
                    label: "Angry",
                    icon: "😠"
                },
                {
                    key: "surprised",
                    label: "Surprised",
                    icon: "😲"
                },
                {
                    key: "fearful",
                    label: "Fear",
                    icon: "😨"
                },
                {
                    key: "disgusted",
                    label: "Disgust",
                    icon: "🤢"
                },
                {
                    key: "neutral",
                    label: "Neutral",
                    icon: "😐"
                }
            ];

            let stream = null;
            let running = false;
            let busy = false;
            let modelReady = false;
            let frameCount = 0;
            let fpsFrames = 0;
            let lastFpsTime = performance.now();
            let startedAt = 0;
            let clockTimer = null;
            let animationTimer = null;
            let history = [];

            function setStatus(text, live = false) {
                $("status").textContent = text.toUpperCase();
                $("liveDot").classList.toggle("live", live);
                $("feedDot").classList.toggle("live", live);
                $("feedStatus").textContent = live ?
                    "ANALYSIS ACTIVE" :
                    text.toUpperCase();
            }

            function clearOverlay() {
                ctx.clearRect(0, 0, overlay.width, overlay.height);
            }

            function resizeOverlay() {
                const w = video.videoWidth || 640;
                const h = video.videoHeight || 400;

                if (overlay.width !== w || overlay.height !== h) {
                    overlay.width = w;
                    overlay.height = h;
                }
            }

            function getTop(scores) {
                return expressions
                    .map(e => ({
                        ...e,
                        score: scores[e.key] || 0
                    }))
                    .sort((a, b) => b.score - a.score)[0];
            }

            async function loadModels() {
                if (modelReady) return;

                setStatus("Loading models");
                $("modelStatus").textContent = "Downloading face & expression models…";
                $("modelBadge").textContent = "LOADING";
                $("modelBadge").style.color = "var(--blue)";

                await Promise.all([
                    faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_PATH),
                    faceapi.nets.faceExpressionNet.loadFromUri(MODEL_PATH)
                ]);

                modelReady = true;
                $("modelStatus").textContent =
                    "Tiny face detector + expression model";
                $("modelBadge").textContent = "READY";
                $("modelBadge").style.color = "var(--green)";
            }

            function renderScores(scores) {
                const top = getTop(scores);
                const pct = Math.round(top.score * 100);

                $("emotionIcon").textContent = top.icon;
                $("emotionName").textContent = top.label;
                $("confidence").textContent = `Top model score · ${pct}%`;
                $("scoreValue").textContent = pct + "%";
                $("scoreRing").style.setProperty(
                    "--score",
                    (top.score * 360) + "deg"
                );

                const colors = {
                    happy: "linear-gradient(90deg,#377df6,#169c72)",
                    neutral: "linear-gradient(90deg,#7468ef,#b7a5ff)",
                    sad: "linear-gradient(90deg,#7e9fff,#9a86ff)",
                    angry: "linear-gradient(90deg,#e75c91,#ffad86)",
                    surprised: "linear-gradient(90deg,#d99124,#ff9c6e)",
                    fearful: "linear-gradient(90deg,#a98aff,#e19bff)",
                    disgusted: "linear-gradient(90deg,#169c72,#a6e57e)"
                };

                $("bars").innerHTML = expressions.map(e => {
                    const n = Math.max(
                        0,
                        Math.min(100, (scores[e.key] || 0) * 100)
                    );

                    const isTop = e.key === top.key;

                    return `
        <div class="emotion-row">
          <div class="emotion-label">
            <span class="emoji">${e.icon}</span>${e.label}
          </div>
          <div class="bar-track">
            <div class="bar-fill"
                 style="width:${n}%;background:${colors[e.key]};
                 opacity:${isTop ? 1 : .72}"></div>
          </div>
          <div class="emotion-pct">${n.toFixed(1)}%</div>
        </div>
      `;
                }).join("");
            }

            function renderFaces(results) {
                $("faceSummary").textContent = `${results.length} TRACKED`;

                if (!results.length) {
                    $("faceList").innerHTML = `
        <div class="empty-state">
          <div class="empty-icon">◉</div>
          No faces detected yet.<br>
          Move into the camera frame to begin.
        </div>
      `;

                    $("emotionIcon").textContent = "◎";
                    $("emotionName").textContent = "No face detected";
                    $("confidence").textContent = "Waiting for a face in view.";
                    $("scoreValue").textContent = "—";
                    $("scoreRing").style.setProperty("--score", "0deg");

                    $("bars").innerHTML = `
        <div class="empty-state">
          No expression scores available for this frame.
        </div>
      `;

                    return;
                }

                $("faceList").innerHTML = results.map((r, i) => {
                    const top = getTop(r.expressions);

                    return `
        <div class="face-card">
          <div class="face-avatar">${String(i+1).padStart(2,"0")}</div>
          <div class="face-meta">
            <div class="face-title">Face ${i+1}</div>
            <div class="face-detail">
              Detection confidence ${(r.detection.score*100).toFixed(0)}%
            </div>
          </div>
          <div class="face-emotion">
            ${top.icon} ${top.label}
            <div class="face-detail">
              ${(top.score*100).toFixed(0)}% score
            </div>
          </div>
        </div>
      `;
                }).join("");

                renderScores(results[0].expressions);
            }

            function drawTimeline() {
                const rect = timeline.getBoundingClientRect();
                const dpr = window.devicePixelRatio || 1;

                if (!rect.width || !rect.height) return;

                timeline.width = Math.round(rect.width * dpr);
                timeline.height = Math.round(rect.height * dpr);

                tctx.setTransform(dpr, 0, 0, dpr, 0, 0);

                const w = rect.width;
                const h = rect.height;
                const pad = {
                    l: 28,
                    r: 8,
                    t: 12,
                    b: 20
                };

                tctx.clearRect(0, 0, w, h);
                tctx.font = "10px system-ui";
                tctx.fillStyle = "#77849d";
                tctx.strokeStyle = "#e8edf5";
                tctx.lineWidth = 1;

                [0, 25, 50, 75, 100].forEach(v => {
                    const y = pad.t + (h - pad.t - pad.b) * (1 - v / 100);

                    tctx.beginPath();
                    tctx.moveTo(pad.l, y);
                    tctx.lineTo(w - pad.r, y);
                    tctx.stroke();

                    if (v === 0 || v === 50 || v === 100) {
                        tctx.fillText(v + "%", 0, y + 3);
                    }
                });

                const series = [{
                        key: "happy",
                        color: "#377df6"
                    },
                    {
                        key: "neutral",
                        color: "#7468ef"
                    },
                    {
                        key: "sad",
                        color: "#e75c91"
                    }
                ];

                if (history.length < 2) {
                    tctx.fillStyle = "#77849d";
                    tctx.textAlign = "center";
                    tctx.fillText(
                        "Trend appears as the session runs",
                        w / 2,
                        h / 2 + 4
                    );
                    tctx.textAlign = "left";
                    return;
                }

                series.forEach(s => {
                    tctx.beginPath();

                    history.forEach((p, i) => {
                        const x = pad.l + (w - pad.l - pad.r) * i / (history.length - 1);
                        const y = pad.t + (h - pad.t - pad.b) * (1 - (p[s.key] || 0));

                        if (i === 0) tctx.moveTo(x, y);
                        else tctx.lineTo(x, y);
                    });

                    tctx.strokeStyle = s.color;
                    tctx.lineWidth = 2;
                    tctx.lineJoin = "round";
                    tctx.lineCap = "round";
                    tctx.stroke();

                    const last = history[history.length - 1];
                    const x = w - pad.r;
                    const y = pad.t + (h - pad.t - pad.b) * (1 - (last[s.key] || 0));

                    tctx.beginPath();
                    tctx.arc(x, y, 3, 0, Math.PI * 2);
                    tctx.fillStyle = s.color;
                    tctx.fill();
                });
            }

            function resetExpression() {
                $("faceList").innerHTML = `
      <div class="empty-state">
        <div class="empty-icon">◉</div>
        No faces detected yet.<br>
        Move into the camera frame to begin.
      </div>
    `;

                $("faceSummary").textContent = "0 TRACKED";
                $("emotionIcon").textContent = "◎";
                $("emotionName").textContent = "Awaiting face";
                $("confidence").textContent =
                    "Start the camera to analyze facial expressions.";
                $("scoreValue").textContent = "—";
                $("scoreRing").style.setProperty("--score", "0deg");

                $("bars").innerHTML = `
      <div class="empty-state">
        <div class="empty-icon">▥</div>
        Expression scores will appear here after a face is detected.
      </div>
    `;
            }

            async function analyze() {
                if (!running || busy) return;

                busy = true;

                try {
                    if (video.readyState < 2) return;

                    resizeOverlay();

                    const results = await faceapi
                        .detectAllFaces(
                            video,
                            new faceapi.TinyFaceDetectorOptions({
                                inputSize: 320,
                                scoreThreshold: .45
                            })
                        )
                        .withFaceExpressions();

                    if (!running) return;

                    clearOverlay();

                    frameCount++;
                    fpsFrames++;

                    $("frames").textContent = frameCount;
                    $("faceCount").textContent = results.length;

                    const resized = faceapi.resizeResults(results, {
                        width: overlay.width,
                        height: overlay.height
                    });

                    resized.forEach((r, i) => {
                        const b = r.detection.box;
                        const top = getTop(r.expressions);

                        ctx.save();
                        ctx.strokeStyle = "#74a5ff";
                        ctx.lineWidth = Math.max(2, overlay.width / 400);
                        ctx.shadowColor = "#377df6";
                        ctx.shadowBlur = 12;
                        ctx.strokeRect(b.x, b.y, b.width, b.height);
                        ctx.restore();

                        const tag = `FACE ${i+1} · ${top.label.toUpperCase()}`;

                        ctx.font = `700 ${Math.max(12,overlay.width/65)}px system-ui`;

                        const fh = Math.max(21, overlay.width / 45);
                        const tw = ctx.measureText(tag).width + 16;
                        const ty = Math.max(0, b.y - fh);

                        ctx.fillStyle = "#74a5ff";
                        ctx.fillRect(b.x, ty, tw, fh);

                        ctx.fillStyle = "#07121c";
                        ctx.fillText(tag, b.x + 8, ty + fh * .69);
                    });

                    renderFaces(results);

                    if (results.length) {
                        const e = results[0].expressions;

                        history.push({
                            happy: e.happy || 0,
                            neutral: e.neutral || 0,
                            sad: e.sad || 0
                        });

                        if (history.length > 35) history.shift();

                        drawTimeline();
                    }

                    const now = performance.now();

                    if (now - lastFpsTime >= 1000) {
                        $("fps").textContent = Math.round(
                            fpsFrames * 1000 / (now - lastFpsTime)
                        );

                        fpsFrames = 0;
                        lastFpsTime = now;
                    }

                } catch (err) {
                    console.error(err);
                    setStatus("Analysis error");
                } finally {
                    busy = false;

                    if (running) {
                        animationTimer = setTimeout(analyze, 45);
                    }
                }
            }

            function startClock() {
                clearInterval(clockTimer);
                startedAt = Date.now();

                clockTimer = setInterval(() => {
                    const s = Math.floor((Date.now() - startedAt) / 1000);

                    $("sessionTime").textContent =
                        String(Math.floor(s / 60)).padStart(2, "0") + ":" +
                        String(s % 60).padStart(2, "0");
                }, 1000);
            }

            $("startBtn").addEventListener("click", async () => {
                if (running) return;

                $("startBtn").disabled = true;
                $("placeholderTitle").textContent = "Preparing your camera";
                $("placeholderText").textContent =
                    "Please allow camera access and wait while the AI models load.";

                setStatus("Initializing");

                try {
                    if (!window.faceapi) {
                        throw new Error(
                            "AI library failed to load. Check your internet connection."
                        );
                    }

                    if (!navigator.mediaDevices ||
                        !navigator.mediaDevices.getUserMedia) {
                        throw new Error(
                            "Camera access requires HTTPS or localhost."
                        );
                    }

                    stream = await navigator.mediaDevices.getUserMedia({
                        video: {
                            facingMode: "user",
                            width: {
                                ideal: 1280
                            },
                            height: {
                                ideal: 720
                            }
                        },
                        audio: false
                    });

                    video.srcObject = stream;
                    await video.play();

                    $("placeholder").hidden = true;
                    video.hidden = false;

                    $("resolution").textContent =
                        `INPUT · ${video.videoWidth} × ${video.videoHeight}`;

                    $("resolutionDetail").textContent =
                        `${video.videoWidth} × ${video.videoHeight} pixels`;

                    $("resolutionBadge").textContent = "ACTIVE";
                    $("resolutionBadge").style.color = "var(--green)";

                    await loadModels();

                    running = true;
                    $("stopBtn").disabled = false;
                    setStatus("Live detection", true);

                    lastFpsTime = performance.now();
                    fpsFrames = 0;

                    startClock();
                    analyze();

                } catch (err) {
                    console.error(err);

                    if (stream) {
                        stream.getTracks().forEach(t => t.stop());
                    }

                    stream = null;
                    video.srcObject = null;
                    video.hidden = true;
                    $("placeholder").hidden = false;

                    $("placeholderTitle").textContent = "Unable to start camera";

                    $("placeholderText").textContent =
                        err.name === "NotAllowedError" ?
                        "Camera permission denied. Allow camera access and try again." :
                        (err.message ||
                            "Check camera access, HTTPS and your internet connection.");

                    $("modelStatus").textContent =
                        err.message || "Model initialization failed";

                    $("modelBadge").textContent = "ERROR";
                    $("modelBadge").style.color = "#e75c5c";

                    setStatus("Setup failed");
                    $("startBtn").disabled = false;
                }
            });

            $("stopBtn").addEventListener("click", () => {
                running = false;

                clearTimeout(animationTimer);
                clearInterval(clockTimer);

                if (stream) {
                    stream.getTracks().forEach(t => t.stop());
                }

                stream = null;
                video.srcObject = null;
                video.hidden = true;
                $("placeholder").hidden = false;

                $("placeholderTitle").textContent = "Session paused";
                $("placeholderText").textContent =
                    "Your camera has been stopped. Start a new session whenever you're ready.";

                $("stopBtn").disabled = true;
                $("startBtn").disabled = false;

                clearOverlay();

                $("fps").textContent = "0";
                $("faceCount").textContent = "0";
                $("sessionTime").textContent = "00:00";
                $("resolution").textContent = "INPUT · CAMERA";
                $("resolutionDetail").textContent = "Waiting for camera";
                $("resolutionBadge").textContent = "—";

                setStatus("System standby");
                resetExpression();
                drawTimeline();
            });

            $("resetBtn").addEventListener("click", () => {
                frameCount = 0;
                fpsFrames = 0;
                history = [];
                lastFpsTime = performance.now();

                $("frames").textContent = "0";
                $("faceCount").textContent = "0";
                $("fps").textContent = "0";
                $("sessionTime").textContent = "00:00";

                resetExpression();
                clearOverlay();
                drawTimeline();

                if (running) {
                    startedAt = Date.now();
                }
            });

            window.addEventListener("resize", drawTimeline);

            drawTimeline();
        })();
    </script>
</body>

</html>
