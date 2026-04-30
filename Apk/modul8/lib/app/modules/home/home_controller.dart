// lib/app/modules/home/home_controller.dart

import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../routes/app_routes.dart';

class HomeController extends GetxController {
  void goToGaleri() => Get.toNamed(Routes.GALERI);
  void goToPuzzle() => Get.toNamed(Routes.PUZZLE);
  void goToPanduan() => Get.toNamed(Routes.PANDUAN);
  void goToTentang() => Get.toNamed(Routes.TENTANG);

  void mulaiPermainan() {
    Get.snackbar(
      '🎮 Siap Bermain!',
      'Memulai puzzle Nasi Goreng...',
      backgroundColor: Colors.orange.shade700,
      colorText: Colors.white,
      duration: const Duration(seconds: 2),
      snackPosition: SnackPosition.TOP,
      borderRadius: 12,
      margin: const EdgeInsets.all(12),
    );
    Future.delayed(const Duration(milliseconds: 600), goToPuzzle);
  }
}
