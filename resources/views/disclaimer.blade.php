@extends('front-layout')
@push('title')
    <title>Disclaimer</title>
@endpush

@section('main-section')
    <main>
        <div class="breadCrumbs">
            <a href="{{ route('index') }}">Home</a>
            <p>Disclaimer</p>
        </div>
        <div class="categoryName">
            <h1>Disclaimer</h1>
        </div>
        <section class="seoContent">
            <h4>General Disclaimer</h4>
            <p>The information provided by bndecorations.com ("we," "us," or "our") on our website is for general
                informational
                purposes only. All information on the site is provided in good faith; however, we make no representation or
                warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability,
                availability, or completeness of any information on the site. Under no circumstance shall we have any
                liability to you for any loss or damage of any kind incurred as a result of the use of the site or reliance
                on any information provided on the site. Your use of the site and your reliance on any information on the
                site is solely at your own risk.</p>
            <h4>External Links Disclaimer</h4>
            <p>The site may contain (or you may be sent through the site) links to other websites or content belonging to or
                originating from third parties or links to websites and features in banners or other advertising. Such
                external links are not investigated, monitored, or checked for accuracy, adequacy, validity, reliability,
                availability, or completeness by us. We do not warrant, endorse, guarantee, or assume responsibility for the
                accuracy or reliability of any information offered by third-party websites linked through the site or any
                website or feature linked in any banner or other advertising. We will not be a party to or in any way be
                responsible for monitoring any transaction between you and third-party providers of products or services.
            </p>
            <h4>Professional Disclaimer</h4>
            <p>The site cannot and does not contain event planning advice. The event planning information is provided for
                general informational and educational purposes only and is not a substitute for professional advice.
                Accordingly, before taking any actions based upon such information, we encourage you to consult with the
                appropriate professionals. We do not provide any kind of event planning advice. The use or reliance of any
                information contained on the site is solely at your own risk.</p>
            <h4>Limitation of Liability</h4>
            <p>To the fullest extent permitted by applicable law, we exclude all representations, warranties, and conditions
                relating to our site and the use of this site. Nothing in this disclaimer will:</p>
            <ul>
                <li>limit or exclude our or your liability for death or personal injury resulting from negligence;</li>
                <li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
                <li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
                <li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
            </ul>
            <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are
                subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including
                liabilities arising in contract, in tort, and for breach of statutory duty.</p>
            <h4>"Use at Your Own Risk" Disclaimer</h4>
            <p>All information on the site is provided "as is," with no guarantee of completeness, accuracy, timeliness, or
                of the results obtained from the use of this information, and without warranty of any kind, express or
                implied, including, but not limited to warranties of performance, merchantability, and fitness for a
                particular purpose. bndecorations.com will not be liable to you or anyone else for any decision made or
                action
                taken in reliance on the information given by the site or for any consequential, special, or similar
                damages, even if advised of the possibility of such damages.</p>
            <h4>Contact Us</h4>
            <p>If you have any questions about this disclaimer, you can contact us:</p>
            <ul>
                <li>By email: info@bndecorations.com</li>
                <li>By visiting this page on our website: www.bndecorations.com/</li>
                <li>By phone number: +91 ****************</li>
            </ul>
            <p>This disclaimer policy aims to protect bndecorations.com from various liabilities while ensuring users are
                aware
                of the nature of the information and services provided. Make sure to review this with a legal professional
                to ensure it meets all necessary legal standards and requirements.</p>
        </section>
    </main>
@endsection

@section('script')
    <script defer src="{{ url('/') }}/assets/js/script-new8.js"></script>
@endsection
