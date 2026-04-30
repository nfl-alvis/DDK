import 'package:flutter/material.dart';
import 'package:modul6/service/http_service.dart';
import 'package:modul6/pages/ToDo_detail.dart';

class ToDoList extends StatefulWidget {
  @override
  _ToDoListState createState() => _ToDoListState();
}

class _ToDoListState extends State<ToDoList> {
  int ToDoCount = 0;
  late List ToDo;
  late HttpService service;

  // List warna untuk card
  final List<Color> cardColors = [
    Colors.green,
    Colors.yellow,
    Colors.blue,
    Colors.orange,
    Colors.purple,
    Colors.red,
    Colors.teal,
  ];

  Future initialize() async {
    ToDo = [];
    ToDo = await service.getTodo();
    setState(() {
      ToDoCount = ToDo.length;
    });
  }

  @override
  void initState() {
    service = HttpService();
    initialize();
    super.initState();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      theme: ThemeData.dark(), // DARK MODE
      home: Scaffold(
        appBar: AppBar(
          title: Text("ToDo List"),
        ),
        body: ListView.builder(
          itemCount: ToDoCount,
          itemBuilder: (context, position) {
            // ambil warna berdasarkan index
            final color = cardColors[position % cardColors.length];

            return Card(
              color: color,
              margin: EdgeInsets.symmetric(horizontal: 12, vertical: 6),
              shape: RoundedRectangleBorder(
                borderRadius: BorderRadius.circular(12),
              ),
              child: ListTile(
                contentPadding: EdgeInsets.all(10),

                title: Text(
                  "Todo #${ToDo[position].id}",
                  style: TextStyle(
                    color: Colors.black,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                subtitle: Text(
                  ToDo[position].title,
                  style: TextStyle(color: Colors.black87),
                ),

                trailing: CircleAvatar(
                  radius: 25,
                  backgroundImage: NetworkImage(
                    "https://i.pravatar.cc/150?img=${position + 1}",
                  ),
                ),

                onTap: () {
                  Navigator.push(
                    context,
                    MaterialPageRoute(
                      builder: (_) => ToDoDetail(todo: ToDo[position]),
                    ),
                  );
                },
              ),
            );
          },
        ),
      ),
    );
  }
}