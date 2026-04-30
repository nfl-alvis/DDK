// lib/app/modules/panduan/panduan_controller.dart

import 'package:get/get.dart';

class PanduanController extends GetxController {
  final RxInt selectedTab = 0.obs;

  void setTab(int index) => selectedTab.value = index;
}
