import 'dart:convert';
import 'dart:io';
import 'package:modul6/models/ToDo.dart';
import 'package:http/http.dart' as http;

class HttpService {
  final String baseUrl = 'https://jsonplaceholder.typicode.com/todos';

  Future<List> getTodo() async {
    final String uri = baseUrl;

    http.Response result = await http.get(
      Uri.parse(uri),
      headers: {"User-Agent": "Mozilla/5.0", "Accept": "application/json"},
    );
    if (result.statusCode == HttpStatus.ok) {
      print("Success");
      final jsonResponse = jsonDecode(result.body);
      List todos = jsonResponse.map((i) => Todo.fromJson(i)).toList();
      return todos;
    } else {
      print("Error");
      return [];
    }
  }
}
