// lib/app/modules/tentang/tentang_binding.dart

import 'package:get/get.dart';
import 'tentang_controller.dart';

class TentangBinding extends Bindings {
  @override
  void dependencies() {
    Get.lazyPut<TentangController>(() => TentangController());
  }
}
