@extends('layouts.app')

@section('title', 'LINE履歴登録')

@section('content')
<div class="slide_wrap" id="howto_wrap">
    <h1><img src="images/h1_howto.png" alt="使い方"></h1>
    <p class="read">このアプリはLINEのトーク履歴を使用して、<br>
        恋愛の可能性をジャッジします。</p>
    <ul class="slick01">
        <li><img alt="使い方1" src="images/slide01.png" /></li>
        <li><img alt="使い方2" src="images/slide02.png" /></li>
        <li><img alt="使い方3" src="images/slide03.png" /></li>
        <li><img alt="診断について" src="images/slide04.png" /></li>
    </ul>
    <p id="close_howto"><span>診断を始める</span></p>
</div>
<div class="container page-index">
    <h1><img src="images/h1_index.png" alt="診断する"></h1>
    <input type="text" id="userName" placeholder="LINEの名前を正確に入力してください" />
    <input type="file" id="file" />
    <textarea id="chatHistory" rows="10" placeholder="ここにLINE履歴を入力してください..." readonly hidden></textarea>

    <div class="privacy" style="margin: 20px 0;">
        <h2>プライバシーポリシー</h2>
        <textarea readonly>
【プライバシーポリシー】

1. はじめに
本プライバシーポリシーは、LINEのトーク履歴をアップロードする恋愛診断アプリ（以下、「本アプリ」）の利用において収集される個人情報の取り扱いについて説明します。本アプリをご利用いただく前に、本プライバシーポリシーをお読みいただき、内容をご理解ください。

2. 収集する情報の種類
本アプリでは、以下の情報を収集することがあります。

2.1 個人情報
ユーザー名
メールアドレス（必要に応じて）
2.2 トーク履歴
ユーザーがアップロードするLINEのトーク履歴
2.3 その他の情報
アプリの利用履歴やアクセスログなどの技術情報
3. 情報の使用目的
収集した情報は、以下の目的で使用されます。

恋愛診断サービスの提供
サービスの向上およびユーザーサポート
利用状況の分析および統計データの作成
4. 情報の保護
収集した個人情報は、適切な管理のもとで厳重に保護されます。不正アクセス、紛失、破壊、改ざん、漏洩などを防止するために、技術的および物理的なセキュリティ対策を実施しています。

5. 情報の共有および提供
ユーザーの同意がない限り、収集した個人情報を第三者に提供することはありません。ただし、法令に基づき開示が求められる場合や、ユーザーの生命、身体、財産の保護のために必要であると判断した場合を除きます。

6. クッキー（Cookie）の使用
本アプリでは、ユーザーの利便性向上や利用状況の分析のために、クッキーを使用することがあります。クッキーは、ユーザーのブラウザに保存される小さなテキストファイルであり、ユーザーを特定するものではありません。

7. プライバシーポリシーの変更
本プライバシーポリシーは、必要に応じて変更されることがあります。変更があった場合は、本アプリ上で通知します。ユーザーは、変更後のプライバシーポリシーに同意したものとみなされますので、定期的にご確認ください。

8. お問い合わせ
プライバシーポリシーに関するお問い合わせは、以下の連絡先までお願いいたします。

メールアドレス：support@love-judge.com
        </textarea>
    </div>

    <div class="teams" style="margin: 20px 0;">
        <h2>利用規約</h2>
<textarea readonly>
第1条（適用）
本利用規約（以下、「本規約」といいます）は、LINEのトーク履歴をアップロードする恋愛診断アプリ（以下、「本アプリ」といいます）を利用する際の条件を定めるものです。本アプリを利用する全てのユーザー（以下、「ユーザー」といいます）は、本規約に同意したものとみなします。

第2条（利用登録）
ユーザーは、本規約に同意の上、本アプリが定める方法により利用登録を行うことができます。
本アプリは、利用登録の申請者に以下の事由があると判断した場合、利用登録の申請を承認しないことがあります。
利用登録の申請に虚偽の事項を届け出た場合
本規約に違反したことがある者からの申請である場合
その他、本アプリが利用登録を相当でないと判断した場合
第3条（ユーザーIDおよびパスワードの管理）
ユーザーは、自己の責任において、本アプリのユーザーIDおよびパスワードを適切に管理するものとします。
ユーザーは、いかなる場合にも、ユーザーIDおよびパスワードを第三者に譲渡または貸与することはできません。本アプリは、ユーザーIDとパスワードの組み合わせが登録情報と一致してログインされた場合には、そのユーザーIDを登録しているユーザー自身による利用とみなします。
第4条（禁止事項）
ユーザーは、本アプリの利用にあたり、以下の行為をしてはなりません。

法令または公序良俗に違反する行為
犯罪行為に関連する行為
本アプリのサーバーまたはネットワークの機能を破壊したり、妨害したりする行為
本アプリの運営を妨害するおそれのある行為
他のユーザーに関する個人情報等を収集または蓄積する行為
不正アクセスをし、またはこれを試みる行為
他のユーザーに成りすます行為
本アプリに関連して、反社会的勢力に対して直接または間接に利益を供与する行為
その他、本アプリが不適切と判断する行為
第5条（本アプリの提供の停止等）
本アプリは、以下のいずれかの事由があると判断した場合、ユーザーに事前に通知することなく、本アプリの全部または一部の提供を停止または中断することができます。
本アプリにかかるコンピュータシステムの保守点検または更新を行う場合
地震、落雷、火災、停電または天災などの不可抗力により、本アプリの提供が困難となった場合
コンピュータまたは通信回線等が事故により停止した場合
その他、本アプリの提供が困難と判断した場合
本アプリの提供の停止または中断により、ユーザーまたは第三者が被ったいかなる不利益または損害についても、本アプリは一切の責任を負わないものとします。
第6条（利用制限および登録抹消）
本アプリは、ユーザーが以下のいずれかに該当する場合には、事前の通知なく、利用制限または登録を抹消することができるものとします。
本規約のいずれかの条項に違反した場合
登録事項に虚偽の事実があることが判明した場合
その他、本アプリの利用を継続することが適当でないと判断した場合
本アプリは、本条に基づき本アプリが行った行為によりユーザーに生じた損害について、一切の責任を負いません。
第7条（免責事項）
本アプリは、本アプリに事実上または法律上の瑕疵（安全性、信頼性、正確性、完全性、有効性、特定の目的への適合性、セキュリティなどに関する欠陥、エラーやバグ、権利侵害など）がないことを明示的にも黙示的にも保証しておりません。
本アプリは、本アプリの利用に起因してユーザーに生じたあらゆる損害について一切の責任を負いません。ただし、本アプリに関する本アプリとユーザーとの間の契約（本規約を含みます。）が消費者契約法に定める消費者契約となる場合、この免責規定は適用されません。
第8条（サービス内容の変更等）
本アプリは、ユーザーへの事前の告知なく、本アプリの内容を変更または提供を中止することができるものとし、それによって生じたユーザーまたは第三者に生じた損害について一切の責任を負いません。

第9条（利用規約の変更）
本アプリは、必要と判断した場合には、ユーザーに通知することなくいつでも本規約を変更することができるものとします。なお、本規約の変更後、本アプリの利用を継続したユーザーは、変更後の規約に同意したものとみなします。

第10条（個人情報の取扱い）
本アプリは、ユーザーの個人情報を適切に取り扱うものとし、本アプリのプライバシーポリシーに従うものとします。

第11条（通知または連絡）
ユーザーと本アプリとの間の通知または連絡は、本アプリの定める方法によって行うものとします。

第12条（権利義務の譲渡の禁止）
ユーザーは、本アプリの書面による事前の承諾なく、利用契約上の地位または本規約に基づく権利もしくは義務を第三者に譲渡し、または担保に供することはできません。

第13条（準拠法・裁判管轄）
本規約の解釈にあたっては、日本法を準拠法とします。本アプリに関して紛争が生じた場合には、本アプリの本店所在地を管轄する裁判所を専属的合意管轄とします。
</textarea>
    </div>

    <div>
        <input type="checkbox" id="agreeTerms"> 規約に同意します
    </div>

    <button class="btn disabled" id="analyzeButton" disabled>診断する</button>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    $('.slick01').slick({
        autoplay: false,
        dots: true,
        responsive: [{
            breakpoint: 640,
            settings: {
                arrows: false,
                slidesToShow: 1,
                centerPadding: "10%",
            },
        }, ],
    });

    function closeHowto() {
        const close_howto = document.getElementById("close_howto");
        const howto_wrap = document.getElementById("howto_wrap");
        if (close_howto.style.display == "block") {
            close_howto.style.display = "none";
            howto_wrap.style.display = "none";
        } else {
            close_howto.style.display = "block";
            howto_wrap.style.display = "block";
        }
    }
    $('#close_howto').click(function() {
        $('#howto_wrap').hide();
    });

    const textarea = document.querySelector('#chatHistory');
    document.querySelector('#file').addEventListener('change', e => {
        if (e.target.files[0]) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                textarea.value = e.target.result;
            };
            reader.readAsText(file);
        }
    });
</script>
<script>

    const checkInputs = () => {
        const userName = document.getElementById('userName').value.trim();
        const file = document.getElementById('file').files.length > 0;
        const agreeTerms = document.getElementById('agreeTerms').checked;
        const analyzeButton = document.getElementById('analyzeButton');

        if (userName && file && agreeTerms) {
            analyzeButton.classList.remove('disabled');
            analyzeButton.disabled = false;
        } else {
            analyzeButton.classList.add('disabled');
            analyzeButton.disabled = true;
        }
    };

    document.getElementById('userName').addEventListener('input', checkInputs);
    document.getElementById('file').addEventListener('change', checkInputs);
    document.getElementById('agreeTerms').addEventListener('change', checkInputs);

    document.getElementById('analyzeButton').addEventListener('click', () => {
        const fullChatHistory = document.getElementById('chatHistory').value;
        const userName = document.getElementById('userName').value;
        const fileName = document.getElementById('file').files[0].name; // ファイル名を取得

        const maxLength = 8000;
        const truncatedChatHistory = fullChatHistory.slice(-maxLength);

        sessionStorage.setItem('chatHistory', truncatedChatHistory);
        sessionStorage.setItem('userName', userName);
        sessionStorage.setItem('fileName', fileName); // ファイル名を保存
        window.location.href = 'progress';
    });
</script>

@endsection
