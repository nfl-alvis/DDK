// lib/app/modules/puzzle/puzzle_controller.dart

import 'dart:async';
import 'dart:math';
import 'package:flutter/material.dart';
import 'package:get/get.dart';

class PuzzleController extends GetxController {
  // ===== STATE =====
  final RxList<int> tiles = <int>[1, 2, 3, 4, 5, 6, 7, 8, 0].obs;
  final RxInt seconds = 0.obs;
  final RxBool isPaused = false.obs;
  final RxBool isLoading = true.obs;
  final RxInt moveCount = 0.obs;

  Timer? _timer;

  @override
  @override
  void onInit() {
    super.onInit();
    _shufflePuzzle();
    _startTimer();
    isLoading.value = false;
  }

  @override
  void onClose() {
    _timer?.cancel();
    super.onClose();
  }

  // ===== TIMER =====
  void _startTimer() {
    _timer?.cancel();
    _timer = Timer.periodic(const Duration(seconds: 1), (_) {
      if (!isPaused.value) seconds.value++;
    });
  }

  void togglePause() {
    isPaused.value = !isPaused.value;
  }

  // ===== PUZZLE LOGIC =====
  void _shufflePuzzle() {
    final random = Random();
    final list = [1, 2, 3, 4, 5, 6, 7, 8, 0];
    for (int i = 0; i < 200; i++) {
      int emptyIdx = list.indexOf(0);
      List<int> validMoves = _getValidMoves(emptyIdx);
      int move = validMoves[random.nextInt(validMoves.length)];
      int temp = list[emptyIdx];
      list[emptyIdx] = list[move];
      list[move] = temp;
    }
    tiles.value = list;
  }

  List<int> _getValidMoves(int emptyIndex) {
    List<int> moves = [];
    int row = emptyIndex ~/ 3;
    int col = emptyIndex % 3;
    if (row > 0) moves.add(emptyIndex - 3);
    if (row < 2) moves.add(emptyIndex + 3);
    if (col > 0) moves.add(emptyIndex - 1);
    if (col < 2) moves.add(emptyIndex + 1);
    return moves;
  }

  bool canMove(int tileIndex) {
    int emptyIndex = tiles.indexOf(0);
    int tr = tileIndex ~/ 3, tc = tileIndex % 3;
    int er = emptyIndex ~/ 3, ec = emptyIndex % 3;
    return (tr == er && (tc - ec).abs() == 1) ||
        (tc == ec && (tr - er).abs() == 1);
  }

  void moveTile(int tileIndex) {
    if (isPaused.value) return;
    if (!canMove(tileIndex)) return;

    int emptyIndex = tiles.indexOf(0);
    final list = tiles.toList();
    list[emptyIndex] = list[tileIndex];
    list[tileIndex] = 0;
    tiles.value = list;
    moveCount.value++;

    if (_isPuzzleSolved()) {
      _timer?.cancel();
      _showWinDialog();
    }
  }

  bool _isPuzzleSolved() {
    for (int i = 0; i < 8; i++) {
      if (tiles[i] != i + 1) return false;
    }
    return tiles[8] == 0;
  }

  void resetGame() {
    seconds.value = 0;
    moveCount.value = 0;
    isPaused.value = false;
    _shufflePuzzle();
    _timer?.cancel();
    _startTimer();
  }

  void showHint() {
    Get.dialog(
      Dialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
        child: Padding(
          padding: const EdgeInsets.all(20),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Text(
                '💡 Hint - Gambar Asli',
                style: TextStyle(
                  fontSize: 18,
                  fontWeight: FontWeight.bold,
                  color: Colors.brown.shade800,
                ),
              ),
              const SizedBox(height: 12),
              ClipRRect(
                borderRadius: BorderRadius.circular(12),
                child: Image.asset(
                  'assets/foods/nasi_goreng.png',
                  height: 220,
                  width: 220,
                  fit: BoxFit.cover,
                  errorBuilder: (_, __, ___) => Container(
                    height: 220,
                    width: 220,
                    color: Colors.grey.shade200,
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Icon(
                          Icons.fastfood,
                          size: 60,
                          color: Colors.grey,
                        ),
                        const SizedBox(height: 8),
                        Text(
                          'Nasi Goreng',
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                            color: Colors.grey.shade700,
                          ),
                        ),
                        const SizedBox(height: 4),
                        Text(
                          '1 2 3\n4 5 6\n7 8 _',
                          style: TextStyle(
                            fontSize: 20,
                            fontWeight: FontWeight.bold,
                            color: Colors.brown.shade600,
                          ),
                          textAlign: TextAlign.center,
                        ),
                      ],
                    ),
                  ),
                ),
              ),
              const SizedBox(height: 16),
              ElevatedButton(
                onPressed: () => Get.back(),
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.brown.shade600,
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                child: const Text('Tutup'),
              ),
            ],
          ),
        ),
      ),
    );
  }

  void _showWinDialog() {
    Get.dialog(
      WillPopScope(
        onWillPop: () async => false,
        child: Dialog(
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(24),
          ),
          child: Padding(
            padding: const EdgeInsets.all(24),
            child: Column(
              mainAxisSize: MainAxisSize.min,
              children: [
                const Text('🎉', style: TextStyle(fontSize: 60)),
                const SizedBox(height: 8),
                Text(
                  'Selamat!',
                  style: TextStyle(
                    fontSize: 28,
                    fontWeight: FontWeight.bold,
                    color: Colors.brown.shade800,
                  ),
                ),
                const SizedBox(height: 8),
                Text(
                  'Puzzle selesai dalam\n${_formatTime(seconds.value)} | ${moveCount.value} gerakan',
                  style: TextStyle(fontSize: 15, color: Colors.grey.shade600),
                  textAlign: TextAlign.center,
                ),
                const SizedBox(height: 24),
                Row(
                  children: [
                    Expanded(
                      child: OutlinedButton(
                        onPressed: () {
                          Get.back();
                          Get.back();
                        },
                        style: OutlinedButton.styleFrom(
                          foregroundColor: Colors.brown.shade700,
                          side: BorderSide(color: Colors.brown.shade300),
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                        child: const Text('Menu'),
                      ),
                    ),
                    const SizedBox(width: 12),
                    Expanded(
                      child: ElevatedButton(
                        onPressed: () {
                          Get.back();
                          resetGame();
                        },
                        style: ElevatedButton.styleFrom(
                          backgroundColor: Colors.orange.shade600,
                          foregroundColor: Colors.white,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                        ),
                        child: const Text('Main Lagi'),
                      ),
                    ),
                  ],
                ),
              ],
            ),
          ),
        ),
      ),
      barrierDismissible: false,
    );
  }

  String get formattedTime => _formatTime(seconds.value);
  String _formatTime(int s) {
    int m = s ~/ 60;
    int sec = s % 60;
    return '${m.toString().padLeft(2, '0')}:${sec.toString().padLeft(2, '0')}';
  }
}
