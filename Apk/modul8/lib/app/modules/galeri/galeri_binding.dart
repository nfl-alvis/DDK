// lib/app/modules/galeri/galeri_binding.dart

import 'package:get/get.dart';
import 'galeri_controller.dart';

class GaleriBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<GaleriController>(() => GaleriController());
  }
}
