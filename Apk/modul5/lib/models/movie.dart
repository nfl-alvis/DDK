class Movie {
  int id = 0;
  String title = '';
  double voteAverage = 0.0;
  String overview = '';
  String posterPath = '';

  Movie(this.id, this.title, this.voteAverage, this.overview, this.posterPath);

  Movie.fromJson(Map<String, dynamic> json) {
    id = json['id'] ?? 0;
    title = json['title'] ?? '';
    voteAverage = (json['vote_average'] as num?)?.toDouble() ?? 0.0;
    overview = json['overview'] ?? '';
    posterPath = json['poster_path'] ?? '';
  }
}