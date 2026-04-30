import 'package:flutter/material.dart';
import 'package:get/get.dart';

import 'app/modules/splash/splash_page.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return GetMaterialApp(
      debugShowCheckedModeBanner: false,
      title: 'Pusaka Rasa Sliding Puzzle',
      theme: ThemeData(primarySwatch: Colors.blue, useMaterial3: true),
      home: const SplashPage(),
    );
  }
}
