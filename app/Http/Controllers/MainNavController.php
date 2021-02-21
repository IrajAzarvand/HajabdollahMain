<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CertificatesAndHonors;
use App\Models\CI;
use App\Models\Gallery;
use App\Models\LocaleContent;
use App\Models\Message;
use App\Models\Product;
use App\Models\ProductCatalog;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MainNavController extends Controller
{

    //get title for buttons from locale content table
    public function BtnTitle($element_title)
    {
        return LocaleContent::where('locale', app()->getLocale())->where('element_title', $element_title)->pluck('element_content')[0];

    }

    //get title for page elements from locale content table
    public function PageSectionsTitle($P, $S, $EID, $ETITLE)
    {
        return LocaleContent::where('locale', app()->getLocale())
            ->where('page', $P)
            ->where('section', $S)
            ->where('element_id', $EID)
            ->where('element_title', $ETITLE)
            ->pluck('element_content')[0];

    }

    public function SharedContents()
    {
        $SharedContents = collect(AllContentOfLocale())
            ->whereIn('page', array('')) //''=>contents for all pages(menus, footer, ...)
            ->all();


        $Footer = collect($SharedContents)->where('section', 'footer');
        foreach ($Footer as $key => $value) {
            if ($value['element_title'] == 'address') {
                $Address = $value['element_content'];
            } elseif ($value['element_title'] == 'copyright') {
                $CopyRight = $value['element_content'];
            } elseif ($value['element_title'] == 'section_title') {
                $SectionTitle = $value['element_content'];
            }
        }

        return [
            'SectionTitle' => $SectionTitle,
            'Address' => $Address,
            'CopyRight' => $CopyRight,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function HomePage()
    {
        $SharedContents = $this->SharedContents();
        $BtnMore = $this->BtnTitle('btn_more');


        $IndexContents = collect(AllContentOfLocale())
            ->whereIn('page', array('welcome')) // 'welcome'=>contents for home page only
            ->all();

        //*************************** SLIDER ********************************************************************* */
        $SliderItems = collect($IndexContents)
            ->whereIn('section', array('slider'))
            ->all();

        $Slider = [];
        foreach ($SliderItems as $item) {

            $item['image'] = asset('storage/Main/Sliders/' . Slider::where('id', $item['element_id'])->value('image'));
            $Slider[] = $item;
        }


        //************************** NEW PRODUCTS ***************************************************************** */
        $NewPrSectionTitle = $this->PageSectionsTitle('welcome', 'NewProducts', 0, 'section_title');


        //get last 3 item of products from db to show in index page
        $NewPr = Product::orderBy('id', 'desc')->take(3)->get();

        //get product name
        $NewPrName = [];
        foreach ($NewPr as $key => $pr) {
            foreach (Locales() as $item) {
                $NewPrName[$key][$item['locale']] = LocaleContent::where(['page' => 'products', 'section' => 'products', 'element_id' => $pr->id, 'locale' => $item['locale'], 'element_title' => 'p_name_' . $item['locale']])->pluck('element_content')[0];
            }
        }


        $NewProducts = [];
        $P_Images = [];
        //collect first image of each product and put it in array
        foreach ($NewPr as $key => $item) {
            $P_Images = unserialize($item->images);
            $NewProducts[$key]['id'] = $item->id;
            $NewProducts[$key]['image'] = asset('storage/Main/Products/' . $item->id . '/' . $P_Images[0]); //get first image of product and save it in array
            $NewProducts[$key]['title_fa'] = $NewPrName[$key]['fa'];
            $NewProducts[$key]['title_en'] = $NewPrName[$key]['en'];
            $NewProducts[$key]['title_ru'] = $NewPrName[$key]['ru'];
            $NewProducts[$key]['title_ar'] = $NewPrName[$key]['ar'];
        }

        //**************************  CATALOGUES ************************************************ */
        $CatalogSectionTitle = $this->PageSectionsTitle('', 'Catalogs', 0, 'section_title');

        //select first image of catalog for each product
        $CatalogItems = [];
        $Catalogues = ProductCatalog::all();

        foreach ($Catalogues as $key => $C) {
            $P_Id = $C->product_id;
            $CatalogItems[$key]['id'] = $C->id;
            $CatalogItems[$key]['image'] = asset('storage/Main/Products/' . $P_Id . '/catalogs/' . unserialize($C->catalog_images)[0]);
        }

        //**************************  PHOTO GALLERY ************************************************ */
        $GallerySectionTitle = $this->PageSectionsTitle('', 'Gallery', 0, 'section_title');

        $Gallery = [];
        foreach (Gallery::with('contents')->get() as $key => $g) {
            $Gallery[$key]['id'] = $g->id;
            $Gallery[$key]['image'] = asset('storage/Main/Gallery/' . $g->id . '/' . unserialize($g->images)[0]);
            foreach (Locales() as $item) {
                $Gallery[$key]['title_' . $item['locale']] = LocaleContent::where(['page' => 'gallery', 'section' => 'gallery', 'element_id' => $g->id, 'locale' => $item['locale'], 'element_title' => 'g_title_' . $item['locale']])->pluck('element_content')[0];
            }
        }

        //**************************  CERTIFICATE AND HONORS ************************************************ */
        $CH_Images = [];
        foreach (CertificatesAndHonors::pluck('Ch_Image')->toArray() as $ch) {
            $CH_Images[] = asset('storage/Main/CH/' . $ch);
        }


        //**************************  LATEST NEWS *********************************************************** */
        $LatestNews = collect($IndexContents)->where('section', 'latestnews');
        $LatestNewsTitle = $LatestNews->where('element_title', 'news_title')->pluck('element_content');


        //**************************       ***************************************************************** */


        return view('welcome', compact('SharedContents', 'IndexContents', 'Slider', 'NewProducts', 'NewPrSectionTitle', 'CatalogSectionTitle', 'BtnMore', 'LatestNewsTitle', 'CH_Images', 'CatalogItems', 'GallerySectionTitle', 'Gallery'));
    }


    /**
     * Display all ptypes and categories including products .
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function AllProducts()
    {
        $SectionTitle = $this->PageSectionsTitle('Products', '', 0, 'section_title');

        $SharedContents = $this->SharedContents();

        $AllCategories = Category::with('contents')->get();
        $CategoriesList = [];
        foreach ($AllCategories as $key => $item) {
            $CategoriesList[$key]['id'] = $item->id;
            $CategoriesList[$key]['name'] = $item->contents()->where('locale', app()->getLocale())->pluck('element_content')[0];
        }

        $AllProducts = Product::with(['contents' => function ($query) {
            $query->where('locale', app()->getLocale());
        }])->get();

        $PList = [];
        foreach ($AllProducts as $key => $product) {
            $PList[$key]['id'] = $product->id;
            $PList[$key]['image'] = asset('storage/Main/Products/' . $product->id . '/' . unserialize($product->images)[0]);
            foreach ($CategoriesList as $cat) {
                if ($product->cat_id == $cat['id'])
                    $PList[$key]['cat'] = $cat['id'];
            }
            $PList[$key]['name'] = $product->contents()->where('element_title', 'p_name_' . app()->getLocale())->pluck('element_content')[0];
        }

        return view('PageElements.Main.Product.AllProducts', compact('SharedContents', 'SectionTitle', 'CategoriesList', 'PList'));
    }


    /**
     * Display product and related products.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function ViewProduct($p_id)
    {
        $SharedContents = $this->SharedContents();

        $PageTitle = $this->PageSectionsTitle('Products', '', 0, 'section_title');
        $ProductIntroductionTitle = $this->PageSectionsTitle('Products', 'ProductIntroduction', 0, 'section_title');
        $ProductNVTitle = $this->PageSectionsTitle('Products', 'NutritionalValue', 0, 'section_title');
        $RelatedProductsTitle = $this->PageSectionsTitle('Products', 'RelatedProducts', 0, 'section_title');
        $BtnViewProductCatalog = $this->PageSectionsTitle('', 'PageElements', 0, 'btn_view_catalog');
        $BtnBack = $this->BtnTitle('btn_back');

        $SelectedProduct = Product::where('id', $p_id)->with('contents')->first();
        $Item['title'] = $SelectedProduct->contents()->where('element_title', 'p_name_' . app()->getLocale())->pluck('element_content')[0];
        foreach (unserialize($SelectedProduct->images) as $images) {
            $Product['images'][] = asset('storage/Main/Products/' . $SelectedProduct->id . '/' . $images);
        }
        $Product['introduction'] = $SelectedProduct->contents()->where('element_title', 'p_introduction_' . app()->getLocale())->pluck('element_content')[0];
        $Product['nutritional_value'] = $SelectedProduct->contents()->where('element_title', 'nutritionalValue_' . app()->getLocale())->pluck('element_content')[0];

        $ProductCatalog = ProductCatalog::where('product_id', $p_id)->value('id');

        $RelatedProducts = Product::where('cat_id', $SelectedProduct->cat_id)->whereNotIn('id', [$SelectedProduct->id])->with('contents')->get();
        $RelatedPList = [];
        foreach ($RelatedProducts as $key => $product) {
            $RelatedPList[$key]['id'] = $product->id;
            $RelatedPList[$key]['image'] = asset('storage/Main/Products/' . $product->id . '/' . unserialize($product->images)[0]);
            $RelatedPList[$key]['name'] = $product->contents()->where('element_title', 'p_name_' . app()->getLocale())->pluck('element_content')[0];
        }
        return view('PageElements.Main.Product.ViewProduct', compact('SharedContents', 'PageTitle', 'Item', 'ProductIntroductionTitle', 'ProductNVTitle', 'RelatedProductsTitle', 'Product', 'RelatedPList', 'ProductCatalog', 'BtnViewProductCatalog', 'BtnBack'));
    }


    /**
     * Display all galleries.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function AllCH()
    {


        $PageTitle = $this->PageSectionsTitle('CH', '', 0, 'section_title');
        $BtnMore = $this->BtnTitle('btn_more');

        $SharedContents = $this->SharedContents();

        $AllCH = CertificatesAndHonors::with('contents')->get();
        $CHList = [];
        foreach ($AllCH as $key => $CH) {
            $CHList[$key]['id'] = $CH->id;
            $CHList[$key]['title'] = $CH->contents()->where('element_title', 'ChTitle_' . app()->getLocale())->pluck('element_content')[0];
            $CHList[$key]['image'] = asset('storage/Main/CH/' . $CH->Ch_Image);

        }
        return view('PageElements.Main.CH.AllCH', compact('SharedContents', 'PageTitle', 'BtnMore', 'CHList'));
    }


    /**
     * Display all galleries.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function ViewCH($ch_id)
    {

        $SelectedCH = CertificatesAndHonors::where('id', $ch_id)->with('contents')->first();
        $SelectedCHTitle = $SelectedCH->contents()->where('element_title', 'ChTitle_' . app()->getLocale())->pluck('element_content')[0];
        $SelectedCHDescription = $SelectedCH->contents()->where('element_title', 'ChDescription_' . app()->getLocale())->pluck('element_content')[0];
        $SelectedCHImage = asset('storage/Main/CH/' . $SelectedCH->Ch_Image);


        $PageTitle = $this->PageSectionsTitle('CH', '', 0, 'section_title');
        $BtnBack = $this->BtnTitle('btn_back');

        $SharedContents = $this->SharedContents();

        return view('PageElements.Main.CH.ViewCH', compact('SharedContents', 'PageTitle', 'BtnBack', 'SelectedCHTitle', 'SelectedCHDescription', 'SelectedCHImage'));
    }


    /**
     * Display all galleries.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function AllGalleries()
    {
        $PageTitle = $this->PageSectionsTitle('Gallery', '', 0, 'section_title');
        $BtnMore = $this->BtnTitle('btn_more');


        $SharedContents = $this->SharedContents();

        $AllGalleries = Gallery::with('contents')->get();
        $GList = [];
        foreach ($AllGalleries as $key => $gallery) {
            $GList[$key]['id'] = $gallery->id;
            $GList[$key]['title'] = $gallery->contents()->where('element_title', 'g_title_' . app()->getLocale())->pluck('element_content')[0];
            $GList[$key]['image'] = asset('storage/Main/Gallery/' . $gallery->id . '/' . unserialize($gallery->images)[0]);
        }

        return view('PageElements.Main.Gallery.AllGalleries', compact('SharedContents', 'PageTitle', 'BtnMore', 'GList'));
    }


    /**
     * Display Gallery and related images.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function ViewGallery($g_id)
    {
        $SharedContents = $this->SharedContents();
        $PageTitle = $this->PageSectionsTitle('Gallery', '', 0, 'section_title');
        $BtnBack = $this->BtnTitle('btn_back');


        $SelectedGallery = Gallery::where('id', $g_id)->with('contents')->first();
        $Gallery = [];
        $Item['title'] = $SelectedGallery->contents()->where('element_title', 'g_title_' . app()->getLocale())->pluck('element_content')[0];
        foreach (unserialize($SelectedGallery->images) as $images) {
            $Gallery['images'][] = asset('storage/Main/Gallery/' . $SelectedGallery->id . '/' . $images);
        }

        return view('PageElements.Main.Gallery.ViewGallery', compact('SharedContents', 'PageTitle', 'Item', 'BtnBack', 'Gallery'));
    }


    /**
     * Display Gallery and related images.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function SalesOffice()
    {
        $SharedContents = $this->SharedContents();

        $PageContents = collect(AllContentOfLocale())
            ->where('page', 'sales_office')
            ->where('section', 'sales_office')
            ->pluck('element_content', 'element_title');

        $PageTitle = $this->PageSectionsTitle('SalesOffices', '', 0, 'section_title');

        return view('PageElements.Main.SalesOffices.SalesOffices', compact('SharedContents', 'PageTitle', 'PageContents'));
    }


    /**
     * Display Gallery and related images.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function CompanyIntroduction()
    {
        $PageTitle = $this->PageSectionsTitle('CI', '', 0, 'section_title');
        $SharedContents = $this->SharedContents();

        $AllCI = CI::with('contents')->get();
        $CIList = [];
        foreach ($AllCI as $key => $CI) {
            $CIList[$key]['title'] = $CI->contents()->where('element_title', 'CITitle_' . app()->getLocale())->pluck('element_content')[0];
            $CIList[$key]['desc'] = $CI->contents()->where('element_title', 'CIDescription_' . app()->getLocale())->pluck('element_content')[0];

        }

        return view('PageElements.Main.CI.CI', compact('SharedContents', 'PageTitle', 'CIList'));
    }


    /**
     * Display all catalogs.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function AllCatalogs()
    {
        $PageTitle = $this->PageSectionsTitle('', 'Catalogs', 0, 'section_title');
        $BtnMore = $this->BtnTitle('btn_more');

        $SharedContents = $this->SharedContents();

        $AllCatalogs = ProductCatalog::get();

        $CList = [];
        foreach ($AllCatalogs as $key => $catalog) {
            $Related_Product = $catalog->product_id;
            $CList[$key]['id'] = $catalog->id;
            $CList[$key]['image'] = asset('storage/Main/Products/' . $Related_Product . '/catalogs/' . unserialize($catalog->catalog_images)[0]);
            $Product_title = LocaleContent::where('page', 'products')->where('section', 'products')->where('element_id', $Related_Product)->where('element_title', 'p_name_' . app()->getLocale())->pluck('element_content')[0];
            $CList[$key]['title'] = $Product_title;
        }
        return view('PageElements.Main.Catalog.AllCatalogs', compact('SharedContents', 'PageTitle', 'BtnMore', 'CList'));
    }


    /**
     * Display catalogs for special product.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function ViewCatalog($c_id)
    {
        $SharedContents = $this->SharedContents();
        $PageTitle = $this->PageSectionsTitle('', 'Catalogs', 0, 'section_title');
        $BtnBack = $this->BtnTitle('btn_back');


        $SelectedCatalog = ProductCatalog::where('id', $c_id)->first();
        $Related_Product = $SelectedCatalog->product_id;
        $Product_title = LocaleContent::where('page', 'products')->where('section', 'products')->where('element_id', $Related_Product)->where('element_title', 'p_name_' . app()->getLocale())->pluck('element_content')[0];
        $Item['title'] = $Product_title;

        $Catalog = [];
        foreach (unserialize($SelectedCatalog->catalog_images) as $image) {
            $Catalog['images'][] = asset('storage/Main/Products/' . $Related_Product . '/catalogs/' . $image);
        }

        return view('PageElements.Main.Catalog.ViewCatalog', compact('SharedContents', 'PageTitle', 'Item', 'Catalog', 'BtnBack'));
    }


    /**
     * Display contact us form
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function Contactus()
    {
        $SharedContents = $this->SharedContents();
        $PageTitle = $this->PageSectionsTitle('CU', 'PageTitle', 0, 'section_title');
        $CompanyName = $this->PageSectionsTitle('CU', 'PageElements', 1, 'Company Name');
        $Address = $this->PageSectionsTitle('', 'footer', 1, 'address');
        $PhoneTitle = $this->PageSectionsTitle('CU', 'PageElements', 2, 'phone number');
        $EmailTitle = $this->PageSectionsTitle('CU', 'PageElements', 3, 'mail title');
        $FormNameTitle = $this->PageSectionsTitle('CU', 'PageElements', 4, 'form name title');
        $FormEmailTitle = $this->PageSectionsTitle('CU', 'PageElements', 5, 'form email title');
        $FormSubjectTitle = $this->PageSectionsTitle('CU', 'PageElements', 6, 'form subject title');
        $FormMessageTitle = $this->PageSectionsTitle('CU', 'PageElements', 7, 'form message title');
        $FormSendMessageBtn = $this->PageSectionsTitle('', 'PageElements', 0, 'btn_send_message');

        return view('PageElements.Main.ContactUs.ContactUs', compact('SharedContents', 'PageTitle', 'CompanyName', 'Address', 'PhoneTitle', 'EmailTitle', 'FormNameTitle', 'FormEmailTitle', 'FormSubjectTitle', 'FormMessageTitle', 'FormSendMessageBtn'));
    }

    /**
     * get message from contact us page and store in DB.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function StoreMessage(Request $request)
    {
        $rules = [
            'name' => ['required', 'regex:/^[\pL\s\-]+$/u'], //acceps alpha and space in this field
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],

        ];
        $this->validate($request, $rules);

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        Message::insert([
            'name'=> $name,
            'email'=>$email,
            'subject'=>$subject,
            'message'=>$message,
        ]);
        $request->session()->flash('status', 'Message Stored!');
        return back();

    }


}
