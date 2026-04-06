import 'package:flutter/material.dart';
import 'package:modul4/models/item.dart';

class HomePage extends StatelessWidget {
  final List<Item> items = [
    Item(
      name: 'Sugar',
      price: 5000,
      description: 'Sweet sugar for drinks',
    ),
    Item(
      name: 'Salt',
      price: 2000,
      description: 'Salt for cooking',
    ),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Shopping List'),
        backgroundColor: Colors.blue,
      ),
      body: ListView.builder(
        itemCount: items.length,
        itemBuilder: (context, index) {
          final item = items[index];

          return ItemCard(item: item);
        },
      ),
    );
  }
}

class ItemCard extends StatelessWidget {
  final Item item;

  const ItemCard({required this.item});

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: () {
        Navigator.pushNamed(
          context,
          '/item',
          arguments: item,
        );
      },
      child: Card(
        elevation: 4,
        margin: EdgeInsets.all(10),
        child: Padding(
          padding: EdgeInsets.all(12),
          child: Row(
            children: [
              Icon(Icons.shopping_cart),
              SizedBox(width: 10),
              Expanded(child: Text(item.name)),
              Text('Rp ${item.price}'),
            ],
          ),
        ),
      ),
    );
  }
}