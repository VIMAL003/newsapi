@php 
$response=json_decode($response,true);
$articles=isset($response['articles']) && !empty($response['articles'])?$response['articles']:[];

@endphp
<div class="row">
  <div class="col-md-12">
    <h4><b>Total Articles:</b> {{@$response['totalArticles']}}</h4>
  <table class="table">
    <thead>
      <tr>
        <th>S.No.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Description</th>
        <th>Content</th>
        <th>URL</th>
        <th>Source Details</th>
        <th>Published At</th>
      </tr>
    </thead>
    <tbody>
    @if(!empty($articles))
    @foreach($articles as $key=>$article)
    @php 
    //print_R($article);
    @endphp
    <tr>
      <td>{{$key+1}}</td>
      <td>{{$article['title']}}</td>
      <td><img width="100px" src="{{$article['image']}}"></td>
      <td>{{$article['description']}}</td>
      <td>{{$article['content']}}</td>
      <td><a target="_blank" href="{{$article['url']}}">{{$article['url']}}</a></td>
      <td>
        @php echo !empty($article['source']['name'])?"<strong>Name:</strong>".$article['source']['name']:""; @endphp
        @php echo !empty($article['source']['name'])?"<br><strong>URL:</strong>".$article['source']['url']:""; @endphp
      </td>
      <td>{{$article['publishedAt']}}</td>
    </tr>
    @endforeach
    @else
    <tr>
      <td colspan="8">no record found</td>
    </tr>
    @endif
    </tbody>
  </table>
</div>
</div>
