@extends('layouts.musitory')

@section('content')
<style>
    .about-hero {
        background: linear-gradient(135deg, #FDF6F0 0%, #FFE8E0 100%);
        padding: 80px 40px;
        text-align: center;
    }
    
    .about-hero h1 {
        font-size: 48px;
        font-weight: 700;
        color: #1B1B18;
        margin-bottom: 20px;
    }
    
    .about-section {
        padding: 80px 40px;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .about-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-bottom: 80px;
    }
    
    .about-text h2 {
        font-size: 32px;
        color: #FF6B35;
        margin-bottom: 20px;
    }
    
    .about-text p {
        font-size: 16px;
        line-height: 1.8;
        color: #1B1B18;
        margin-bottom: 20px;
    }
    
    .about-image {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .about-image img {
        width: 100%;
        height: auto;
    }
    
    .philosophy-section {
        background: #FDF6F0;
        padding: 80px 40px;
        text-align: center;
    }
    
    .philosophy-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        max-width: 1200px;
        margin: 40px auto 0;
    }
    
    .philosophy-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }
    
    .philosophy-icon {
        font-size: 48px;
        margin-bottom: 20px;
    }
    
    .philosophy-card h3 {
        font-size: 24px;
        color: #1B1B18;
        margin-bottom: 15px;
    }
    
    .philosophy-card p {
        font-size: 15px;
        line-height: 1.6;
        color: #706F6C;
    }
    
    .timeline-section {
        padding: 80px 40px;
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .timeline {
        position: relative;
        padding: 40px 0;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #E3E3E0;
        transform: translateX(-50%);
    }
    
    .timeline-item {
        position: relative;
        padding: 20px 0;
        display: flex;
        align-items: center;
    }
    
    .timeline-item:nth-child(even) {
        flex-direction: row-reverse;
    }
    
    .timeline-content {
        width: 45%;
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }
    
    .timeline-year {
        font-size: 24px;
        font-weight: 700;
        color: #FF6B35;
        margin-bottom: 10px;
    }
    
    .timeline-dot {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 20px;
        height: 20px;
        background: #FF6B35;
        border-radius: 50%;
        border: 4px solid white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .contact-section {
        background: #f8f9fa;
        padding: 80px 40px;
        text-align: center;
    }
    
    .contact-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        max-width: 800px;
        margin: 40px auto 0;
    }
    
    .contact-item {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
    }
    
    .contact-item h3 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #1B1B18;
    }
    
    .contact-item p {
        font-size: 14px;
        color: #706F6C;
        line-height: 1.6;
    }
    
    @media (max-width: 768px) {
        .about-content {
            grid-template-columns: 1fr;
        }
        
        .timeline::before {
            left: 20px;
        }
        
        .timeline-item,
        .timeline-item:nth-child(even) {
            flex-direction: column;
            padding-left: 60px;
        }
        
        .timeline-content {
            width: 100%;
        }
        
        .timeline-dot {
            left: 20px;
        }
    }
</style>

<div class="about-hero">
    <h1>About MUSITORY + MUAS</h1>
    <p>새로운 음악교육 콘텐츠 개발 에듀테크 기업</p>
</div>

<section class="about-section">
    <div class="about-content">
        <div class="about-text">
            <h2>음악과 이야기의 만남</h2>
            <p>
                2009년 프랑스 파리에서 <strong>동화와 음악을 접목한 콘서트</strong>를 시작으로
                수년간 연구 끝에 동화로 음악을 배우는 새로운 방법을
                유아음악교육에 도입했습니다.
            </p>
            <p>
                <strong>뮤직(Music)</strong>과 <strong>이야기(Story)</strong>의 합성어인
                <strong>뮤지토리(Musitory)</strong>는
                음악과 이야기를 바탕으로 만든 뮤아스의 콘텐츠입니다.
            </p>
            <p>
                2012년 음악과 이야기를 통합한 <strong>스토리텔링 콘서트</strong>를 열고
                <strong>뮤지토리</strong> 음악교육 프로그램을 개발하여
                유아부터 청소년을 대상으로 다양한 음악교육과 공연 활동을 해왔습니다.
            </p>
        </div>
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?w=600" alt="뮤지토리 공연">
        </div>
    </div>
    
    <div class="about-content" style="grid-template-columns: 1fr 1fr;">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600" alt="뮤지토리 교육">
        </div>
        <div class="about-text">
            <h2>에듀테크 기업으로의 도약</h2>
            <p>
                2022년 <strong>㈜뮤아스</strong>를 창립하며 에듀테크 기업으로 새로운 도약을 시작합니다.
                국내외 교육시장은 끊임없이 양질의 교육콘텐츠를 필요로 합니다.
            </p>
            <p>
                뮤아스는 어린 아이부터 누구나 쉽게 음악을 즐길 수 있는 교육 프로그램과
                보다 체계적인 음악교육을 할 수 있는 교육시스템을 제공하고 있습니다.
            </p>
            <p>
                동화작가, 피아니스트, 성악가, 뮤지컬 배우 등 국내 최고 음악교육 전문가가 만들고
                수년간 무대 위에서 증명된 뮤지토리의 공연 기획력과 교육 프로그램으로
                더 나은 미래를 위한 예술교육과 문화예술의 대중화를 위해 최선의 노력을 다하겠습니다.
            </p>
        </div>
    </div>
</section>

<section class="philosophy-section">
    <h2 style="font-size: 36px; margin-bottom: 20px;">뮤지토리 교육 철학</h2>
    <p style="font-size: 18px; color: #706F6C;">모든 아이는 음악적 잠재력을 가지고 있습니다</p>
    
    <div class="philosophy-cards">
        <div class="philosophy-card">
            <div class="philosophy-icon">🎵</div>
            <h3>통합적 음악교육</h3>
            <p>음악과 이야기, 움직임을 통합한 전인적 교육으로 아이들의 창의성과 표현력을 키워갑니다.</p>
        </div>
        <div class="philosophy-card">
            <div class="philosophy-icon">❤️</div>
            <h3>아이 중심 교육</h3>
            <p>각 아이의 개성과 발달 단계를 존중하며, 눈높이에 맞춘 맞춤형 교육을 제공합니다.</p>
        </div>
        <div class="philosophy-card">
            <div class="philosophy-icon">🌟</div>
            <h3>즐거운 음악 경험</h3>
            <p>억지로 하는 음악이 아닌, 스스로 즐기고 표현하는 음악의 기쁨을 경험하게 합니다.</p>
        </div>
    </div>
</section>

<section class="timeline-section">
    <h2 style="text-align: center; font-size: 36px; margin-bottom: 60px;">뮤지토리 연혁</h2>
    
    <div class="timeline">
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2009</div>
                <p>프랑스 파리에서 동화와 음악을 접목한 첫 콘서트 개최</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2012</div>
                <p>스토리텔링 콘서트 시작, 뮤지토리 교육 프로그램 개발</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2015</div>
                <p>국내 주요 문화센터 및 교육기관과 제휴 시작</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2018</div>
                <p>누적 수강생 1,000명 돌파, 우수 교육 프로그램 선정</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2022</div>
                <p>㈜뮤아스 법인 설립, 에듀테크 기업으로 전환</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
        
        <div class="timeline-item">
            <div class="timeline-content">
                <div class="timeline-year">2025</div>
                <p>온라인 플랫폼 런칭, 전국 서비스 확대</p>
            </div>
            <div class="timeline-dot"></div>
        </div>
    </div>
</section>

<section class="contact-section">
    <h2 style="font-size: 36px; margin-bottom: 20px;">Contact Us</h2>
    <p style="font-size: 18px; color: #706F6C;">뮤지토리와 함께하고 싶으신가요?</p>
    
    <div class="contact-info">
        <div class="contact-item">
            <h3>🏢 ADDRESS</h3>
            <p>
                30152 세종특별자치시 한누리대로 2264<br>
                (대평동) 씨티오브드림 607
            </p>
        </div>
        <div class="contact-item">
            <h3>📞 TEL</h3>
            <p>
                010-7327-3379<br>
                평일 09:00 ~ 17:00
            </p>
        </div>
        <div class="contact-item">
            <h3>✉️ E-MAIL</h3>
            <p>
                musitory@naver.com<br>
                문의사항은 이메일로 보내주세요
            </p>
        </div>
    </div>
</section>
@endsection
