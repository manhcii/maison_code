<div class="comments topmargin">
    <h3>Nhận xét</h3>
    <div id="reviews" class="clearfix">
        <div style="max-height: 300px;overflow-y: auto;" class="over">
            <ol class="commentlist border-bottom-0 clearfix">
                @if ($review)
                    @foreach ($review as $review)
                    <li id="li-comment-{{ $review->id }}"
                        class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1">
                        <div id="comment-{{ $review->id }}" class="comment-wrap clearfix">
                            <div class="comment-meta">
                                <div class="comment-author vcard">
                                    <span class="comment-avatar clearfix">
                                        <img alt='Image' src='{{ asset('public/data/cms-image/img_ns.png') }}'
                                            class='avatar avatar-60 photo' height='60' width='60' /></span>
                                </div>
                            </div>

                            <div class="comment-content clearfix">
                                <div class="comment-author">{{ $review->name }}
                                    <span>{{ $review->created_at }}</span>
                                </div>

                                <p>{{ $review->comment }}</p>

                                <div style="position: absolute; top: 0; left: auto; right: 40px; color: #FEC42D;">
                                    @if ($review->rating && $review->rating > 0)
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="icon-star3"></i>
                                        @endfor
                                    @endif
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </li>
                    @endforeach
                @endif

            </ol>
        </div>
        <a href="#" data-bs-toggle="modal" data-bs-target="#reviewFormModal" class="button m-0 float-end">Thêm Review</a>
    </div>
</div>


<div class="modal fade" id="reviewFormModal" role="dialog" aria-labelledby="reviewFormModalLabel"
    aria-hidden="true"tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="reviewFormModalLabel">
                    Form review
                </h4>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form class="row mb-0" action="{{ route('frontend.review.store.product') }}" method="post">
                    @csrf
                    <div class="col-6 mb-3">
                        <label for="template_reviewform_name">Tên <small>*</small></label>
                        <div class="input-group">
                            <div class="input-group-text">
                                <i class="icon-user"></i>
                            </div>
                            <input required
                                type="text"id="template_reviewform_name"name="template_reviewform_name"value="{{ old('template_reviewform_name') }}"class="form-control required" />
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="template_reviewform_email">Email <small>*</small></label>
                        <div class="input-group">
                            <div class="input-group-text">@</div>
                            <input required
                                type="email"id="template_reviewform_email"name="template_reviewform_email"value="{{ old('template_reviewform_email') }}"class="required email form-control" />
                        </div>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-12 mb-3">
                        <label for="template_reviewform_rating">Đánh giá</label>
                        <select id="template_reviewform_rating" name="template_reviewform_rating" class="form-select">
                            <option value="">-- Lựa chọn --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>

                    <div class="w-100"></div>

                    <div class="col-12 mb-3">
                        <label for="template_reviewform_comment">Nội dung
                            <small>*</small></label>
                        <textarea required class="required form-control" id="template_reviewform_comment" name="template_reviewform_comment"
                            rows="6" cols="30">{{ old('template_reviewform_comment') }}</textarea>
                    </div>
                    <input type="hidden" name="id_product_review" value="{{ $detail->id }}">
                    <div class="col-12">
                        <button class="button button-3d m-0 " type="submit">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Đóng
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
