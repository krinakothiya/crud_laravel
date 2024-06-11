@extends('layouts.app')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #19BCBF !important;

    }

    .select2-container--default .select2-selection--single {
        background-color: #f5f5f5;
        border: 2px solid #ced4da !important;
        border-radius: 4px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #6f6f6f !important;
        color: #fff;

    }

    .select2-container--default .select2-results__option {
        padding-top: 1px;
        padding-bottom: 1px;
        padding-left: 17px !important;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 17px !important;
        padding-top: 4px !important;
        font-size: 14px !important;
    }

    .ck-editor__editable {
        height: 100px !important;
    }

    #image-preview {
        max-height: 92px;
        width: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
        padding: 5px;
    }

    /* .select2-container--default .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove{
        color: black !important;

    } */
    input[type="file"] {
        display: block;
    }

    .imageThumb {
        max-height: 75px;
        border: 2px solid;
        padding: 1px;
        cursor: pointer;
    }

    .pip {
        display: inline-block;
        margin: 10px 10px 0 0;
    }

    .remove {
        display: block;
        background: #444;
        border: 1px solid black;
        color: white;
        text-align: center;
        cursor: pointer;
        width: 100px;
    }

    .remove:hover {
        background: white;
        color: black;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }
</style>
@section('backend_content')
<!-- [ Main Content ] start -->
<div class="row">
    <!-- [ form-element ] start -->
    <div class="col-sm-12">
        <!-- Basic Inputs -->
        <form method="post" action="{{url('product/update')}}/{{$id}}" enctype="multipart/form-data" id="CountryForm">
            @csrf
            @method('PATCH')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product General Details</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Category *</label>
                            <select name="category_id" class='form-control custom_width form-control-light'>
                                <option value="">Select article category </option>
                                <?php foreach ($category as $category) { ?>
                                    @if($product->product_category_id == $category->category_id)
                                    <option value="<?php echo $category->category_id; ?>" selected><?php echo  $category->category_name;     ?></option>
                                    @else
                                    <option value="<?php echo $category->category_id; ?>"><?php echo  $category->category_name;     ?></option>
                                    @endif
                                <?php } ?>
                            </select>
                            <span class="text-danger kt-form__help error category_id"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product Title* </label>
                            <input type="text" id="product_title" name="product_title" class="form-control" value="{{$product->product_title}}" placeholder="Enter Product title">
                            <span class="text-danger kt-form__help error product_title"></span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product SKU Code* </label>
                            <input type="text" name="product_code" class="form-control" value="{{$product->product_code}}" placeholder="Enter Product code">
                            <span class="text-danger kt-form__help error product_code"></span>
                        </div>

                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Product storage* </label>
                            <input type="text" name="product_storage" class="form-control"  value="{{$product->product_storage}}" placeholder="Enter Product storage">
                            <span class="text-danger kt-form__help error product_storage"></span>
                        </div> -->

                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Product Self Life* </label>
                            <input type="text" name="product_self_life" class="form-control" value="{{$product->product_self_life}}" placeholder="Enter Product  Self Life">
                            <span class="text-danger kt-form__help error product_self_life"></span>
                        </div> -->
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Product General Price* </label>
                            <input type="text" name="general_price" value="{{$product->general_price}}" class="form-control" placeholder="Enter Product General Price">
                            <span class="text-danger kt-form__help error general_price"></span>
                        </div> -->
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">Usage*</label>
                            <input type="text" id="usage" name="usage" value="{{$product->usage}}" class="form-control" placeholder="Enter Product Usage">
                            <span class="text-danger kt-form__help error usage"></span>
                        </div> -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Thumbnail* <b>(Image size: 400px X 400px)</b> </label>
                            <input type="file" name="product_thumbnail" id="product_thumbnail" class="form-control" onchange="previewImage(this, 'imagePreview1')" onclick="product_thumbnailClicked(this)">
                            <img id="imagePreview1" style="max-width: 80px; max-height: 80px; margin-top: 10px;" src="{{ $product->product_thumbnail ? asset('public/assets/images/product_thumbnail/' . $product->product_thumbnail) : '' }}">
                            <span class="text-danger kt-form__help error product_thumbnail" id="tex_form_error"></span><br>
                            <span class="remove" id="removeImageButton" onclick="removeImage()">Remove Image</span>
                            <span class="text-danger product_thumbnail_error"></span>
                        </div>

                    </div>

                    <div class="custom-control custom-switch custom-control-inline">
                        <input type="checkbox" name="is_active" class="custom-control-input input-primary" id="customCheckinlh1" {{ ($product->is_active) == 1 ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customCheckinlh1">is Active?</label>
                    </div>

                </div>

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Description</h4>
                </div>
                <div class="card-body">
                    <div class="form-row">

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Overview* </label>
                            <textarea class="" name="product_overview" id="classic-editor3" rows="10">{{$product->product_overview}}</textarea>
                            <!-- <span class="text-danger kt-form__help error product_overview"></span> -->
                            <span class="text-danger  overview_error"></span>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">Description* </label>
                            <textarea class="" name="product_description" id="classic-editor1" rows="10">{{$product->product_description}}</textarea>
                            <span class="text-danger kt-form__help error product_description"></span>
                            <span class="text-danger  description_error"></span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Ingredient* </label>
                            <textarea class="" name="product_ingredient" id="classic-editor2" rows="10">{{$product->product_ingredient}}</textarea>
                            <!-- <span class="text-danger kt-form__help error product_ingredient"></span> -->
                            <span class="text-danger  ingredient_error"></span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Packet Info* </label>
                            <textarea class="" name="product_receipe" id="classic-editor4" rows="10">{{$product->product_receipe}}</textarea>
                            <!-- <span class="text-danger kt-form__help error product_receipe"></span> -->
                            <span class="text-danger  receipe_error"></span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Meta Description* </label>
                            <textarea class="" name="keyword_description" id="classic-editor5" rows="10">{{$product->keyword_description}}</textarea>
                            <!-- <span class="text-danger kt-form__help error keyword_description"></span> -->
                            <span class="text-danger  keyword_error"></span>
                        </div>
                    </div>

                </div>

            </div>

            <!-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Receipe</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Receipe* </label>
                            <textarea class="" name="product_receipe" id="classic-editor4" rows="10">{{$product->product_receipe}}</textarea>      
                            <span class="text-danger kt-form__help error product_receipe"></span>
                            <span class="text-danger  receipe_error"></span>
                    </div>
                </div>
            </div> -->

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Available Product Size</h4>
                </div>
                <div class="card-body">
                    @if(count($ProductVariation) != 0)
                    @php $variation_id =1; @endphp
                    @foreach($ProductVariation as $ProductVariation)
                    <div class="row variation_div">


                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product Type*</label>
                            <input type="text" name="product_type[]" value="{{$ProductVariation->product_type}}" class="form-control form-control-sm product_type" placeholder="Enter product type" onclick="product_typeClicked(this)">
                            <span class="text-danger product_type_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product Weight*</label>
                            <input type="text" name="weight[]" value="{{$ProductVariation->product_weight}}" class="form-control form-control-sm weight" placeholder="Enter product Weight" onclick="weightClicked(this)">
                            <span class="text-danger  weight_error"></span>
                        </div>

                        <!-- <div class="col-md-3 mb-3">
                                <button type="button" class="btn btn-primary btn-circle btn-xl add_button"  title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div> -->
                        @if($variation_id != 1)
                        <div class="col-md-3 mb-3">
                            <a href="javascript:void(0);" style="margin-top:25px; margin-left:20px; color:white" class="btn btn-danger btn-circle btn-xl remove_button" title="Remove field" onclick="remove_button(this)">- </a>
                        </div>
                        @else
                        <div class="col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                        @endif
                    </div>
                    @php $variation_id =$variation_id+1; @endphp
                    @endforeach
                    @else
                    <div class="row variation_div">


                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product Typ*</label>
                            <input type="text" name="product_type[]" class="form-control form-control-sm product_type" placeholder="Enter product Height" onclick="product_typeClicked(this)">
                            <span class="text-danger product_type_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product Weight*</label>
                            <input type="text" name="weight[]" class="form-control form-control-sm weight" placeholder="Enter product Weight" onclick="weightClicked(this)">
                            <span class="text-danger  weight_error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                    </div>
                    @endif
                    <div id="variation_card"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cost Calculator</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Per Unit Weight (gm)* </label>
                            <input type="text" name="product_unit_weight" value="{{$product->product_unit_weight}}" class="form-control" placeholder="Enter Per Unit Weight">
                            <span class="text-danger kt-form__help error product_unit_weight"></span>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Product General Price* </label>
                            <input type="text" name="general_price" value="{{$product->general_price}}" class="form-control" placeholder="Enter Product General Price">
                            <span class="text-danger kt-form__help error general_price"></span>
                        </div>

                    </div>
                    <div class="row main_cal_div">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product</label>
                            <input type="text" value="{{$product->product_title}}" name="main_general_product_title" class="form-control form-control-sm" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (Grams)*</label>
                            <input type="text" name="main_qty_grams" value="{{ isset($mainCostproduct) ? $mainCostproduct->qty_grams : '' }}" class="form-control form-control-sm qty_grams" placeholder="Enter Qty (Grams)" onclick="qtyGramsClicked(this)">
                            <span class="text-danger qty_grams_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (%)*</label>
                            <input type="text" name="main_qty_percent" value="{{ isset($mainCostproduct) ? $mainCostproduct->qty_percent : '' }}" class="form-control form-control-sm qty_percent" placeholder="Enter Qty (%)" onclick="qtyPercentClicked(this)">

                            <span class="text-danger qty_percent_error"></span>
                            <span class="text-danger kt-form__help error qty_percent"></span>
                        </div>
                    </div>
                    <h6 class="card-title" style="padding-top: 20px;">Edit General Products</h6>
                    @if(count($CostCalculator) != 0)
                    @php $costCal_id =1; @endphp
                    @foreach($CostCalculator as $costCal)
                    <div class="row calculator_div">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product*</label>
                            <select name="general_product_title[]" class='form-control custom_width form-control-light general_product_title' onclick="general_productClicked(this)">
                                <option value="">Select Product</option>
                                @foreach($general_product as $val)
                                @if($val->title == $costCal->general_product_title)
                                <option value="{{$val->title}}" selected>{{$val->title}}</option>
                                @else
                                <option value="{{$val->title}}">{{$val->title}}</option>
                                @endif
                                @endforeach
                            </select>
                            <span class="text-danger general_product_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (Grams)*</label>
                            <input type="text" name="qty_grams[]" value="{{$costCal->qty_grams}}" class="form-control form-control-sm qty_grams" placeholder="Enter Qty (Grams)" onclick="qtyGramsClicked(this)">
                            <span class="text-danger qty_grams_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (%)*</label>
                            <input type="text" name="qty_percent[]" value="{{$costCal->qty_percent}}" class="form-control form-control-sm qty_percent" placeholder="Enter Qty (%)" onclick="qtyPercentClicked(this)">
                            <span class="text-danger qty_percent_error"></span>
                            <span class="text-danger kt-form__help error qty_percent"></span>
                        </div>

                        @if($costCal_id != 1)
                        <div class="col-md-3 mb-3">
                            <a href="javascript:void(0);" style="margin-top:25px; margin-left:20px; color:white" class="btn btn-danger btn-circle btn-xl remove_button" title="Remove field" onclick="cal_remove_button(this)">- </a>
                        </div>
                        @else
                        <div class="col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl cal_add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                        @endif
                    </div>
                    @php $costCal_id =$costCal_id+1; @endphp
                    @endforeach
                    @else
                    <div class="row calculator_div">
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product*</label>
                            <select name="general_product_title[]" class='form-control custom_width form-control-light general_product_title' onclick="general_productClicked(this)">
                                <option value="">Select Product</option>
                                @foreach($general_product as $val)
                                <option value="{{$val->title}}">{{$val->title}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger general_product_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (Grams)*</label>
                            <input type="text" name="qty_grams[]" class="form-control form-control-sm qty_grams" placeholder="Enter Qty (Grams)" onclick="qtyGramsClicked(this)">
                            <span class="text-danger qty_grams_error"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">QTY (%)*</label>
                            <input type="text" name="qty_percent[]" class="form-control form-control-sm qty_percent" placeholder="Enter Qty (%)" onclick="qtyPercentClicked(this)">
                            <span class="text-danger qty_percent_error"></span>
                            <span class="text-danger kt-form__help error qty_percent"></span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl cal_add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                    </div>
                    @endif
                    <div id="calculator_card"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Media</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="form-label">Images <b>(Image size: 400px X 400px)</b></label>
                        <div class="">
                            <input type="file" id="files" name="files[]" multiple / onclick="multipleImageClicked(this)">
                            <span class="text-danger files_error"></span>
                            @foreach($ProductImage as $media)
                            <!-- <input type="hidden" id="file_exist" name="file_exist[]" value="{{ asset('public/hotel/' .$media->hotel_media_name) }}" /> -->

                            <span class="pip" id="pip_{{$media->product_image_id}}">
                                <img class="imageThumb" src="{{ asset('public/assets/images/product_images/' .$media->product_image_name) }}" title="">
                                <br /><span class="remove" onclick="deleteimage({{$media->product_image_id}})">Remove image</span>
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product FAQ</h4>
                </div>
                <div class="card-body">
                    @if(count($ProductsFAQ) != 0)
                    @php $faq_id =1; @endphp
                    @foreach($ProductsFAQ as $ProductsFAQ)
                    <div class="row faq_div">
                        <div class="col-md-11 mb-3">
                            <div class="form-group">
                                <label class="form-label">Question*</label>
                                <input type="text" name="question[]" value="{{$ProductsFAQ->product_faq_question}}" class="form-control form-control-sm question" placeholder="Enter Question " onclick="questionClicked(this)">
                                <span class="text-danger question_error"></span>
                                <span class="text-danger kt-form__help error question"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Answer* </label>
                                <textarea class="answer" name="answer[]" id="editor{{$ProductsFAQ->product_faq_id}}" rows="10" onclick="answerClicked(this)">{{$ProductsFAQ->product_faq_answer}}</textarea>
                                <span class="text-danger  answer_error"></span>
                            </div>
                        </div>

                        @if($faq_id != 1)
                        <div class="col-md-1 mb-3">
                            <a href="javascript:void(0);" style="margin-top:25px;  color:white" class="btn btn-danger btn-circle btn-xl faq_remove_button" title="Remove field" onclick="faq_remove_button(this)">- </a>
                        </div>
                        @else
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl faq_add_button" title="Add field" style="margin-top:25px;">+ </button>
                        </div>
                        @endif
                    </div>
                    @php $faq_id =$faq_id+1; @endphp
                    @endforeach
                    @else
                    <div class="row faq_div">
                        <div class="col-md-11 mb-3">
                            <div class="form-group">
                                <label class="form-label">Question*</label>
                                <input type="text" name="question[]" class="form-control form-control-sm question" placeholder="Enter Question " onclick="questionClicked(this)">
                                <span class="text-danger question_error"></span>
                                <span class="text-danger kt-form__help error question"></span>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Answer* </label>
                                <textarea class="answer" name="answer[]" id="answer" rows="10" onclick="answerClicked(this)"></textarea>
                                <span class="text-danger  answer_error"></span>
                            </div>
                        </div>

                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl faq_add_button" title="Add field" style="margin-top:25px;">+ </button>
                        </div>
                    </div>
                    @endif
                    <div id="faq_card"></div>

                </div>

                <!-- <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Receipe</h4>
                </div>
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label">Receipe</label>
                      <select class="form-control receipe-multiple" multiple="multiple" name="article_id[]" id="">
                            <option value=''>Select</option>
                            @foreach($articles as $val)


                            <option value="<?php echo $val['article_id'] ?>" <?php if (in_array($val['article_id'], $articles_data)) { ?> selected <?php } ?>><?php echo $val['article_title'] ?></option>

                            @endforeach
                        </select>
                        <small class="text-danger error article_id"></small>
                    </div> -->

            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product Method</h4>
                </div>

                <div class="card-body">
                    <div class="row method_div">
                        <div class="col-md-11 mb-3 mt-3">
                            <label class="form-label">Receipe youtube Link*</label>
                            <input type="text" name="youtube_link" value="{{$product->youtube_link}}" class="form-control form-control-sm youtube_link" placeholder="Enter product youtube_link">
                            <span class="text-danger youtube_link_error"></span>
                        </div>
                    </div>
                    @if(count($receipeMethod) != 0)
                    @php $methodId = 1; @endphp
                    @foreach($receipeMethod as $item)
                    <div class="row method_div">

                        <div class="col-md-11 mb-3">
                            @foreach($receipe_icon as $val)
                            <div class="form-check d-inline-block mr-2 ml-2">
                                <label class="form-check-label" for="path-main-{{$val->recipe_method_id}}">
                                    <img src="<?= url('/'); ?>/public/{{$val->receipe_icon_path }}" alt="{{ $val->receipe_icon_path }}" style="width:50px;">
                                    <br>
                                    <center>
                                        <input type="checkbox" name="recipe_icon_id[]" value="{{$val->receipe_icon_path}}" class="form-check-input check-main-{{$methodId}} mt-2 recipe_icon_id" id="path-main-{{$val->recipe_method_id}}" onclick="getCheckboxClass('check-main-{{$methodId}}', this)" @if($val->receipe_icon_path == $item->recipe_icon_id) checked @endif>
                                    </center>
                                </label>
                            </div>
                            @endforeach
                            <span class="text-danger recipe_icon_id_error"></span>
                        </div>
                        @if($methodId != 1)
                        <div class="col-md-1 mb-3">
                            <a href="javascript:void(0);" style="margin-top:25px; margin-left:20px; color:white" class="btn btn-danger btn-circle btn-xl remove_button" title="Remove field" onclick="method_remove_button(this)">- </a>
                        </div>
                        @else
                        <div class="col-md-1 mb-3">
                            <button type="button" class="btn btn-primary btn-circle btn-xl method_add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                        @endif


                        <div class="col-md-11 mb-3">
                            <label class="form-label">Receipe Method* </label>
                            <textarea class="method" name="recipe_method_description[]" id="method_{{$item->recipe_method_id}}" rows="10" onclick="methodClicked(this)">{{ $item->recipe_method_description }}</textarea>
                            <span class="text-danger method_error"></span>
                        </div>

                    </div>
                    @php
                    $methodId = $methodId+1;
                    @endphp
                    @endforeach
                    @else
                    <div class="row method_div">
                        <div class="col-md-11 mb-3">
                            @foreach($receipe_icon as $val)
                            <div class="form-check d-inline-block mr-2 ml-2">
                                <label class="form-check-label" for="path-main-{{$val->recipe_method_id}}">
                                    <img src="<?= url('/'); ?>/public/{{$val->receipe_icon_path }}" alt="{{ $val->receipe_icon_path }}" style="width:50px;">
                                    <br>
                                    <center>
                                        <input type="checkbox" name="recipe_icon_id[]" onclick="product_tilteClicked(this)" value="{{$val->receipe_icon_path}}" class="form-check-input check-main mt-2" id="path-main-{{$val->recipe_method_id}}" onclick="getCheckboxClass('check-main', this)">
                                    </center>
                                </label>
                            </div>
                            @endforeach
                            <!-- <label class="form-label">Method*</label>
                            <select name="receipe_icon_id[]" class='form-control custom_width form-control-light product_id' onclick="product_tilteClicked(this)">
                                <option value="">Select Product</option>
                                @foreach ($receipe_icon as $val)
                                <option value="{{ $val->receipe_icon_path }}">{{ $val->receipe_icon_path }}</option>
                                @endforeach
                            </select> -->
                            <div class="form-group mt-3">
                                <span class="text-danger error receipe_icon_id_error"></span>

                                <label class="form-label">Description*</label>
                                <textarea class="method" name="recipe_method_description[]" id="method" rows="10" onclick="methodClicked(this)"></textarea>
                                <span class="text-danger method_error"></span>
                            </div>
                        </div>
                        <div class=" mb-3 mt-1">
                            <button type="button" class="btn btn-primary btn-circle btn-xl method_add_button" title="Add field" style="margin-top:25px; margin-left:20px">+ </button>
                        </div>
                    </div>
                    @endif
                    <div id="method_card"></div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <a href="{{url('article/list')}}" class="btn btn-light">Cancel</a>
                </div>
            </div>


        </form>
    </div>

</div>
<!-- [ Main Content ] end -->
@endsection


@section('backend_page_js')

<script src="{{ asset('public/assets/js/custom/countryMaster.js') }}"></script>
<script src="{{ asset('public/assets/plugins/ckeditor/js/ckeditor.js') }}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="{{ asset('public/assets/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/plugins/select2.full.min.js') }}"></script>
<script>
    $(".receipe-multiple").select2({
        // allowClear: true
        placeholder: "Select",
    });
</script>
<script>
    document.getElementById('product_title').addEventListener('input', function() {
        var productTitle = this.value;
        var generalProductField = document.querySelector('[name="main_general_product_title"]');
        generalProductField.value = productTitle;
    });

    function getCheckboxClass(yourCheckboxClass, checkbox) {
        const checkboxes = document.querySelectorAll(`.${yourCheckboxClass}`);

        for (const otherCheckbox of checkboxes) {
            if (otherCheckbox !== checkbox && otherCheckbox.checked) {
                otherCheckbox.checked = false;
                // otherCheckbox.disabled = true;
            } else {
                // otherCheckbox.disabled = false;
            }
        }
    }
</script>
<script>
    const editors = {}


    $(document).ready(function() {
        // $('.article').select2();
        //  ---------------------------------------------- variation start -------------------------------------------------  
        var maxField = 10;
        var addButton = $('.add_button');
        var wrapper = $('#variation_card');

        var x = 1;
        var z = 1;
        var y = 2;
        var count = 1;

        //Once add button is clicked
        $('.add_button').click(function() {


            $('.product_type_error').html('');
            $('.weight_error').html('');
            z++;

            if (!validateVariation()) {

                return;
            }

            var fieldHTML = `
                            <div class="row variation_div ">
                            
                              
                                <div class="col-md-3 mb-3">
                                        <label class="form-label">Product Type*</label>
                                        <input type="text" name="product_type[]" class="form-control form-control-sm product_type" placeholder="Enter product Height" onclick="product_typeClicked(this)" >
                                      <span class="text-danger product_type_error"></span>
                                                    </div>
                                <div class="col-md-3 mb-3">
                                        <label class="form-label">Product Weight*</label>
                                        <input type="text" name="weight[]" class="form-control form-control-sm weight" placeholder="Enter product Weight" onclick="weightClicked(this)" >
                                      <span class="text-danger  weight_error"></span>
                                                    </div>
                    
                                <div class="col-md-3 mb-3">
                                    <a href="javascript:void(0);" style="margin-top:25px; margin-left:20px; color:white" class="btn btn-danger btn-circle btn-xl remove_button" class="btn btn-lg btn-block btn-danger lift text-uppercase remove_button" title="Remove field">- </a>
                                </div> 
                                </div>
                                       `;
            count++;
            if (x < maxField) {
                x++;
                y++;
                $('#variation_card').append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            y = 1;
            x--;
        });
        remove_button = function(self) {
            $(self).parent('div').parent('div').remove();
            y = 1;
            x--;
        }

        function validateVariation() {
            var isValid = true;

            $('.variation_div').each(function() {
                let variation_price = $(this).find('input.variation_price');

                let product_type = $(this).find('input.product_type');
                let weight = $(this).find('input.weight');



                if (product_type.val() == '') {
                    isValid = false;
                    $(product_type).siblings('.product_type_error').html("Please enter product type");
                }
                if (weight.val() == '') {
                    isValid = false;
                    $(weight).siblings('.weight_error').html("Please enter product Weight");
                } else if (!/^\d+$/.test(weight.val())) {
                    isValid = false;
                    $(weight).siblings('.weight_error').html("Please enter a valid integer value for product Weight");
                }
            });

            return isValid;
        }
        //  ---------------------------------------------- variation end -------------------------------------------------  


        function validateForm() {
            var VariationValid = validateVariation();
            var CalculatorValid = validateCalculator();
            var MainCalculatorValid = validateMainCalculator();
            var FAQValid = validateFAQ();
            var productValid = validateProduct();
            var methodvalid = validateMethod();

            //var ImageValid= validateImage();
            var Product_thumbnailValid = validateProduct_thumbnail();

            // var isValid = VariationValid && ArticleValid && FAQValid && ImageValid && Product_thumbnailValid;

            var isValid = VariationValid && FAQValid && methodvalid && CalculatorValid && productValid && Product_thumbnailValid && MainCalculatorValid;

            //var isValid = isDepthInputValid;
            console.log(isValid);
            return isValid;
        };
        $('form').on('submit', validateForm);

        product_thumbnailClicked = function(self) {
            $('.product_thumbnail_error').html("");
        }
        multipleImageClicked = function(self) {
            $('.files_error').html("");
        }
        variation_priceClicked = function(self) {
            $(self).siblings('.variation_price_error').html("");
        }
        $(document).on('focus', '.variation_price', function() {
            $(this).siblings('.variation_price_error').html("");
        });

        product_typeClicked = function(self) {
            $(self).siblings('.product_type_error').html("");
        }
        $(document).on('focus', '.product_type', function() {
            $(this).siblings('.product_type_error').html("");
        });
        weightClicked = function(self) {
            $(self).siblings('.weight_error').html("");
        }
        $(document).on('focus', '.weight', function() {
            $(this).siblings('.weight_error').html("");
        });
        article_typeClicked = function(self) {
            $(self).siblings('.article_type_error').html("");
        }
        articleClicked = function(self) {
            $(self).siblings('.article_error').html("");
        }
        questionClicked = function(self) {
            $(self).siblings('.question_error').html("");
        }
        answerClicked = function(self) {
            $(self).siblings('.answer_error').html("");
        }
        // Cost Calculator
        general_productClicked = function(self) {
            $(self).siblings('.general_product_error').html("");
        }
        $(document).on('focus', '.general_product_title', function() {
            $(this).siblings('.general_product_error').html("");
        });
        qtyGramsClicked = function(self) {
            $(self).siblings('.qty_grams_error').html("");
        }
        $(document).on('focus', '.qty_grams', function() {
            $(this).siblings('.qty_grams_error').html("");
        });
        qtyPercentClicked = function(self) {
            $(self).siblings('.qty_percent_error').html("");
        }
        $(document).on('focus', '.qty_percent', function() {
            $(this).siblings('.qty_percent_error').html("");
        });
    });
</script>