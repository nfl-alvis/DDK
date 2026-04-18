import 'package:flutter/material.dart';
import 'package:modul6/models/ToDo.dart';

class ToDoDetail extends StatelessWidget {
  final Todo todo;

  ToDoDetail({required this.todo});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.black,
      appBar: AppBar(title: Text("ToDo Detail"), backgroundColor: Colors.black),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Card(
          color: Colors.grey[900],
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          elevation: 5,
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                // ID
                Text(
                  "Todo #${todo.id}",
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                    color: Colors.white,
                  ),
                ),

                SizedBox(height: 12),

                // TITLE
                Text(
                  todo.title ?? "No Title",
                  style: TextStyle(fontSize: 18, color: Colors.white70),
                ),

                SizedBox(height: 20),

                // STATUS
                Row(
                  children: [
                    Text(
                      "Status: ",
                      style: TextStyle(
                        fontSize: 18,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                    Container(
                      padding: EdgeInsets.symmetric(
                        horizontal: 12,
                        vertical: 6,
                      ),
                      decoration: BoxDecoration(
                        color: todo.completed == true
                            ? Colors.green
                            : Colors.red,
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Text(
                        todo.completed == true ? "Completed" : "Not Completed",
                        style: TextStyle(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  ],
                ),

                SizedBox(height: 20),

                Center(
                  child: CircleAvatar(
                    radius: 40,
                    backgroundImage: NetworkImage(
                      "https://i.pravatar.cc/150?u=${todo.id}",
                    ),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
