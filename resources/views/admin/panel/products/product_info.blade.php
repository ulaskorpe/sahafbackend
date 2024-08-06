 
                    
                   
                        <form class="form" id="product-form" name="product-form"
                            action="{{ route('products-update') }}" method="post" enctype="multipart/form-data">


                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" id="id" value="{{ $product['id'] }}">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="maöe" class="form-control-label">Ürünü ekleyen</label></div>
                                <div class="col-12 col-md-9">

                                   {{$product->user()->first()->name}}
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="maöe" class="form-control-label">Ürün
                                        Adı</label></div>
                                <div class="col-12 col-md-9">

                                    <input type="text" id="title" name="title" placeholder="product adı" value="{{ $product['title'] }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Etiket
                                        (slug)</label></div>
                                <div class="col-12 col-md-9">
                                    <span id="slug-span">{{$product['slug']}}</span>
                                    <input type="hidden" id="slug" name="slug" placeholder="Text" value="{{ $product['slug'] }}"
                                        class="form-control">
                                </div>
                            </div>


                            <div class="row form-group">
                                <div class="col col-md-3"><label for="description"
                                        class=" form-control-label">Ön Yazı</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="prologue" id="prologue"  value="{{ $product['prologue'] }}"
                                    placeholder="önyazı..." class="form-control" ></input>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-12">
                                    <input type="hidden" name="product" id="product">
                                    <div id="div_editor1"> </div>
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col col-md-3"><label for="start_price"
                                        class=" form-control-label">Başlangıç Fiyatı</label></div>
                                <div class="col-3 col-md-3">
                                    <input class="form-control" type="number" value="{{$product['start_price']}}" name="start_price" id="start_price">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="buy_now_price"
                                        class=" form-control-label">Hemen Al Fiyatı</label></div>
                                <div class="col-3 col-md-3">
                                    <input class="form-control" type="number" value="{{$product['buy_now_price']}}" name="buy_now_price" id="buy_now_price">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="bid_price"
                                        class=" form-control-label">Enaz arttırma tutarı</label></div>
                                <div class="col-3 col-md-3">
                                    <input class="form-control" type="number" value="{{$product['bid_price']}}" name="bid_price" id="bid_price">
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="description"
                                        class=" form-control-label">Onaylandı</label></div>
                                <div class="col-12 col-md-9">
                                    @if(!empty($product['verified'])) 
                                    <input type="checkbox" name="verified" id="verified" value="13" data-toggle="switchbutton" checked >

                                        {{ Carbon\Carbon::parse($product['verified'])->format('d.m.Y H:i')}} ,
                                            @if($product->verified_by()->first())
                                        {{$product->verified_by()->first()->name}}
                                            @endif
                                        @else 
                                        <input type="checkbox" name="verified" id="verified" value="13" data-toggle="switchbutton"  >
                                    @endif

                                   
                                </div>
                            </div>
                            <div id="cats_div"></div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="description"
                                        class=" form-control-label">Youtube Video</label></div>
                                <div class="col-12 col-md-9">
                                    <input type="text" name="youtube_link" id="youtube_link"  value="{{$product['youtube_link']}}"
                                    placeholder="https://www.youtube.com/watch?v...." class="form-control" ></input>
                                </div>
                            </div>
                          @if(!empty($product['youtube_link']))
                          <div class="row form-group">
                            <div class="col col-md-12"> 
                         
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/{{$youtube_link}}" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    
                          @endif


                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">product
                                        Resmi</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="icon" name="icon"
                                        class="form-control-file"></div>
                            </div>
                            
                            @if($product->icon)
                            <div class="row form-group" id="preview_pic" >
                                <div class="col col-md-3"></div>
                                <div class="col-12 col-md-9">
                                    <a href="#" data-toggle="modal" data-target="#mediumModal" onclick="show_image('icon',{{$product->id}})">
                                    <img id="previewImage" src="{{url('/files/products/'.$product->slug.'/'.$product->icon)}}" alt="Preview Image"
                                        style="max-width: 300px">
                                    </a>
                                </div>
                            </div>
                            @else
                            <div class="row form-group" id="preview_pic" style="display: none">
                                <div class="col col-md-3"></div>
                                <div class="col-12 col-md-9">
                                    <img id="previewImage" src="#" alt="Preview Image"
                                        style="max-width: 300px">
                                </div>
                            </div>
                            @endif
                          
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-multiple-input"
                                        class=" form-control-label"></label></div>
                                <div class="col-12 col-md-9"><button onclick="formSubmit()" id="submit_button"
                                        class="btn btn-primary" onmouseover="fillproduct()">Güncelle</button></div>
                            </div>
                            <textarea id="tmptxt" style="display: none">{{$product_txt}}</textarea>
                        </form>
                    
 