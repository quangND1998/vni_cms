<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('themes')->insert([
            [
                'title' => 'theme1',
                'image_template' => 'images/theme/16534497031_theme1png.PNG',
                'link_code' => 'template.theme1',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'lĩnh vực ứng dụng',
                'image_template' => 'images/theme/16534644831_linhvucpng.PNG',
                'link_code' => 'template.linhvuc',
                'type' => 2,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'video-about',
                'image_template' => 'images/theme/16534647261_video-aboutpng.PNG',
                'link_code' => 'template.video-about',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Typical customers',
                'image_template' => 'images/theme/16536276471_customerpng.PNG',
                'link_code' => 'template.customer',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => '3d-render',
                'image_template' => 'images/theme/16536358121_3d-renderingpng.PNG',
                'link_code' => 'template.3d-render',
                'type' => 1,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'virtual reality',
                'image_template' => 'images/theme/16539918921_virtual-realitypng.PNG',
                'link_code' => 'template.virtual-reality',
                'type' => 1,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'thông tin cập nhật',
                'image_template' => 'images/theme/16538861291_update-infopng.PNG',
                'link_code' => 'template.update-information',
                'type' => 2,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Dự án nổi bật',
                'image_template' => 'images/theme/16541335401_du-an-noi-batpng.PNG',
                'link_code' => 'template.outstanding-project',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'Contact now',
                'image_template' => 'images/theme/1657770967-contact-sectionpng.PNG',
                'link_code' => 'template.contact_now',
                'type' => 0,
                'created_at' => new DateTime()
            ],

            [
                'title' => 'contact form',
                'image_template' => 'images/theme/16541454161_contact-section-2png.PNG',
                'link_code' => 'template.contact_form',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'header',
                'image_template' => 'images/theme/16541537201_headerpng.PNG',
                'link_code' => 'template.header',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'new_about',
                'image_template' => 'images/theme/16578697141_imersive-aboutpng.PNG',
                'link_code' => 'template.new_about',
                'type' => 0,
                'created_at' => new DateTime()
            ],
           
            [
                'title' => 'nemoviz_event',
                'image_template' => 'images/theme/16577038541_holmia-eventpng.PNG',
                'link_code' => 'template.nemoviz_event',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'tintuc_nemoviz',
                'image_template' => 'images/theme/16577653031_tintuc-nemovizpng.PNG',
                'link_code' => 'template.tintuc_nemoviz',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'contact image',
                'image_template' => 'images/theme/16577895431_contact-detailpng.PNG',
                'link_code' => 'template.contact_image',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            [
                'title' => 'contact about us',
                'image_template' => 'images/theme/16578698671_contact-about-uspng.PNG',
                'link_code' => 'template.contact_about_us',
                'type' => 0,
                'created_at' => new DateTime()
            ],
            
         
            
        ]);
    }
}
