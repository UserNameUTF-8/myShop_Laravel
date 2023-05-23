


@props(['item'])



<div class="card  card-hover">
  <div class="img ratio ratio-1x1">
      <img src="{{ Storage::url($item->prodImg) }}" class="card-img-top img-fluid" style="max-width:100%;" alt="img">
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$item->prodName}}</h5>
    <p class="card-text text-truncate" style="overflow: hidden">{{ $item->pordDesc }}</p>
    <p class="card-text"><small class="text-muted">{{ $item->prodPrice }}dt</small></p>
    <a href="{{ route('showProduct', ['id' => $item->idProd]) }}" class="btn btn-outline-primary">Learn more</a>
  </div>
</div>