<div class="wa__btn_popup" onclick="trackWhatsAppPopupOpen()">
    <div class="wa__btn_popup_txt">
        {{ __('wa_need_help') }} <span><strong>{{ __('wa_get_in_touch') }}</strong></span>
    </div>
    <div class="wa__btn_popup_icon"></div>
</div>

<div class="wa__popup_chat_box">
    <div class="wa__popup_heading">
        <div class="wa__popup_title">
            <strong>{{ __('wa_questions') }}</strong>
        </div>
        
        <div class="wa__popup_intro">
            {!! __('wa_chat_intro_html') !!}
            <div id="eJOY__extension_root"></div>
        </div>
    </div>
    
    <div class="wa__popup_content wa__popup_content_left">
        <div class="wa__popup_notice">{{ __('wa_response_time') }}</div>
        
        <div class="wa__popup_content_list">
            <div class="wa__popup_content_item">
                <a target="_blank" 
                   href="https://web.whatsapp.com/send?phone=905050267127" 
                   class="wa__stt wa__stt_online"
                   onclick="trackWhatsAppClick(this, 'popup_widget', '905050267127', 'support_team'); return true;">
                    <div class="wa__popup_avatar">
                        <div class="wa__cs_img_wrap" style="background: url(https://cdn-icons-png.flaticon.com/128/15678/15678795.png) center center no-repeat; background-size: cover;"></div>
                    </div>
                    <div class="wa__popup_txt">
                        <div class="wa__member_name">{{ __('wa_company_name') }}</div>
                        <div class="wa__member_duty">{{ __('wa_support_team') }}</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
