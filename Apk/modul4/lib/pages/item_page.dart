import 'package:flutter/material.dart';
import 'package:modul4/models/item.dart';

class ItemPage extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    final Item itemArgs =
        ModalRoute.of(context)!.settings.arguments as Item;

    String hargaBersih =
        itemArgs.price.toString().replaceAll('\$', '');

    return Scaffold(
      appBar: AppBar(
        title: Text(itemArgs.name),
        backgroundColor: Colors.blue,
      ),
      body: Padding(
        padding: EdgeInsets.all(16),
        child: Card(
          elevation: 6,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(16),
          ),
          child: Container(
            width: double.infinity, // 🔥 INI KUNCINYA
            padding: EdgeInsets.all(20),
            child: Column(
              mainAxisSize: MainAxisSize.min, // tinggi tetap fleksibel
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  itemArgs.name,
                  style: TextStyle(
                    fontSize: 24,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                SizedBox(height: 15),

                Text(
                  'Rp $hargaBersih',
                  style: TextStyle(
                    fontSize: 20,
                    color: Colors.green,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                SizedBox(height: 20),

                Text(
                  'Deskripsi',
                  style: TextStyle(
                    fontSize: 16,
                    fontWeight: FontWeight.bold,
                  ),
                ),

                SizedBox(height: 8),

                Text(
                  itemArgs.description,
                  style: TextStyle(fontSize: 14),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}