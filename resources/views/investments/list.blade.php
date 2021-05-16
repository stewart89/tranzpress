<div class="card-body p-0 border-top-0">
	<div class="table-responsive">
		<table id="investments-list-table" class="table mb-0 table-hover">
			<thead>
				<tr>
					<th>Név</th>
                    <th>Típus</th>
                    <th>Dátum</th>
                    <th>Befektetett összeg</th>
                    <th>Deviza</th>
                    <th>Árfolyam</th>
                    <th>Vásárolt mennyiség</th>
                    <th>Tervezett éves hozam</th>
                    <th>Tervezett futamidő</th>
					<th class="text-right" style="width: 30px;">Müveletek</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($investments as $key => $investment)
				<tr>
					<td><b class="font-weight-bold">{{$investment->name}}</b></td>
                    <td>{{$investment->type->name}}</td>
                    <td>{{$investment->transaction_date}}</td>
                    <td>{{$investment->amount}}</td>
                    <td>{{$investment->currency}}</td>
                    <td>{{($investment->exchange_rate)? $investment->exchange_rate . ' Ft' : '-'}}</td>
                    <td>{{$investment->quantity}} db.</td>
                    <td>{{$investment->anual_income}} %</td>
                    <td>{{$investment->term}} hó</td>

                    <td class="text-right">
						<div class="btn-group table-actions">
							<a href="javascript:void(0)" class="action-item text-muted mr-3" data-type="edit"  data-id="{{$investment->id}}">
								<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
									class="feather feather-edit">
									<path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
									<path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
								</svg>
							</a>

                            <form method="POST" action="{{ route('investments.destroy', $investment->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="" type="submit" onclick="return confirm('Biztosan törölni akarod a #'+{!!$investment->id!!} + ' befektetést?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-trash-2">
                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                    </svg>
                                </button>
                            </form>

						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="card-footer overflow-auto">
	<div class="flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center">
		<nav class="d-flex justify-content-start align-items-center">
			<ul class="pagination mb-0">
				<li class="page-item {{ ($investments->currentPage() == 1) ? ' disabled' : '' }}">
					<a href="{{ $investments->url(1) }}" class="page-link" aria-label="Előző">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-chevron-left">
							<polyline points="15 18 9 12 15 6"></polyline>
						</svg>
					</a>
				</li>
				@for ($i = max($investments->currentPage() - 4, 1); $i <= min($investments->currentPage() + 4, $investments->lastPage()); $i++)
				<li class="page-item {{ ($investments->currentPage() == $i) ? ' active' : '' }}">
					<a href="{{ $investments->url($i) }}" class="page-link">{{ $i }}</a>
				</li>
				@endfor
				<li class="page-item {{ ($investments->currentPage() == $investments->lastPage()) ? ' disabled' : '' }}">
					<a class="page-link" href="{{ $investments->url($investments->currentPage()+1) }}" aria-label="Következő">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-chevron-right">
							<polyline points="9 18 15 12 9 6"></polyline>
						</svg>
					</a>
				</li>
			</ul>
			<p class="mb-0 ml-3 font-size-sm d-none d-md-inline-flex text-nowrap">{{($investments->currentPage() == 1)? 1 : (($investments->currentPage() - 1) * $investments->perPage()) + 1}} -
				{{ ($investments->total() < $investments->currentPage() * $investments->perPage())? $investments->total() : $investments->currentPage() * $investments->perPage()}} / <b>{{$investments->total()}}</b></p>
		</nav>
	</div>
</div>
