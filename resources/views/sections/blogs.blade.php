<div class="tp-blog-area pb-70 pt-70">
    <div class="container container-1775">
        <h2 class="section-title"><span style="color:#d51920;">#</span> Blog Yazılarımız</h2>
        <p class="section-subtitle">Öne Çıkan Makaleler</p>
        <div class="row">

            @foreach ($featuredPosts as $post)
                <div class="col-xl-3 col-lg-6 col-md-6 mb-50">
                    <div class="tp-blog-item tp_fade_bottom">
                        <div class="tp-blog-thumb fix p-relative">
                            <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}">
                            <div class="tp-blog-meta">
                                <span>{{ $post->published_at->format('d. M. Y') }}</span>
                            </div>
                        </div>
                        <div class="tp-blog-content">
                            <h4 class="tp-blog-title-sm">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="postbox__read-more text-center">
                <a href="blog-details.html" class="tp-btn-border-lg">Tüm Yazılar</a>
            </div>
        </div>

    </div>
</div>

<div class="fq-faq-area fq-faq-bdr pt-30 pb-70">
    <div class="container">
       <div class="row">
          <div class="col-xl-8 col-lg-8">
             <div class="fq-faq-wrapper">
                <div class="tp-service-2-accordion-box">
                   <div class="accordion" id="accordionExample">
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Web tasarımı hizmetleriniz nelerdir?
                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                Next Medya olarak, kullanıcı dostu ve estetik açıdan çekici web tasarımları sunuyoruz. Hem masaüstü hem de mobil uyumlu tasarımlar ile markanızın dijital varlığını güçlendiriyoruz.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Özel yazılım geliştirme süreci nasıl işliyor?
                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                Özel yazılım geliştirme sürecimiz, ihtiyaç analizi ile başlar ve prototip oluşturma aşaması ile devam eder. Her aşamada sizinle iletişim kurarak, beklentilerinizi en iyi şekilde karşılamaya çalışıyoruz.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Dijital pazarlama stratejilerinizi nasıl belirliyorsunuz?                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                Dijital pazarlama stratejilerimiz, hedef kitleniz, sektör analizi ve pazar trendleri göz önünde bulundurularak oluşturulur. Bu sayede marka bilinirliğinizi artırmaya yönelik etkili bir plan sunuyoruz.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                E-ticaret altyapılarınız hangi özelliklere sahip?
                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                E-ticaret altyapılarımız, güvenli ödeme sistemleri, kullanıcı dostu arayüz ve ölçeklenebilir yapı özellikleri ile öne çıkıyor. Bu sayede online satış süreçlerinizi kolayca yönetebilirsiniz.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                Sosyal medya yönetimi hizmetleriniz neleri kapsıyor?
                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                Sosyal medya yönetimi hizmetlerimiz, içerik üretimi, pazarlama kampanyaları ve analiz raporlaması gibi çeşitli alanları içerir. Markanızın sosyal medya hesaplarını etkin bir şekilde yönetiyoruz.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                         <h2 class="accordion-header">
                            <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                SEO çalışmaları hakkında bilgi verebilir misiniz?
                               <span class="accordion-icon"></span>
                            </button>
                         </h2>
                         <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                               <p>
                                SEO çalışmalarımız, anahtar kelime araştırması, site içi optimizasyon ve backlink analizleri gibi alanları kapsar. Amacımız, arama motorlarında görünürlüğünüzü artırmaktır.
                               </p>
                            </div>
                         </div>
                      </div>
                      <div class="accordion-items">
                        <h2 class="accordion-header">
                           <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Hangi sektörlere hizmet veriyorsunuz?
                              <span class="accordion-icon"></span>
                           </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <p>
                                Farklı sektörlere yönelik çözümler sunarak geniş bir yelpazede hizmet veriyoruz. Sağlık, eğitim, e-ticaret ve daha birçok alanda deneyimimiz bulunmaktadır.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="accordion-items">
                        <h2 class="accordion-header">
                           <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Proje teslim sürelerinizle ilgili bilgi alabilir miyim?
                              <span class="accordion-icon"></span>
                           </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <p>
                                 Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do. eiusmod tempor
                                 incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                 exercitation ullamco laboris.!
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="accordion-items">
                        <h2 class="accordion-header">
                           <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Proje teslim sürelerinizle ilgili bilgi alabilir miyim?
                              <span class="accordion-icon"></span>
                           </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <p>
                                Proje teslim sürelerimiz, projenin kapsamına ve karmaşıklığına bağlı olarak değişmektedir. Başlangıçta belirlenen süreye sadık kalarak çalışıyoruz.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="accordion-items">
                        <h2 class="accordion-header">
                           <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Müşteri desteği nasıl sağlanıyor?
                              <span class="accordion-icon"></span>
                           </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <p>
                                Müşteri destek ekibimiz, projenizin her aşamasında size yardımcı olmak için hazır bulunmaktadır. Sorularınıza hızlı ve etkili bir şekilde yanıt vermekteyiz.
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="accordion-items">
                        <h2 class="accordion-header">
                           <button class="accordion-buttons collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                Hizmetleriniz hakkında nasıl daha fazla bilgi alabilirim?
                              <span class="accordion-icon"></span>
                           </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              <p>
                                Hizmetlerimiz hakkında daha fazla bilgi almak için web sitemizi ziyaret edebilir veya bizimle iletişime geçebilirsiniz. Size en kısa sürede geri dönüş yapacağız.
                              </p>
                           </div>
                        </div>
                     </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="col-xl-4 col-lg-4">
             <div class="fq-faq-sidebar">
                <div class="fq-faq-sidebar-content">
                   <h4 class="fq-faq-sidebar-title">S.S.S</h4>
                   <p>
                    Eğer aradığınız bilgiye bu sayfada ulaşamazsanız, bizimle iletişime geçmekten çekinmeyin. Ekibimiz size en kısa sürede yardımcı olmaktan memnuniyet duyacaktır.
                   </p>
                </div>
                <div class="fq-faq-sidebar-thumb">
                   <img class="w-100" src="{{ asset('avatar.png') }}" alt="">
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
