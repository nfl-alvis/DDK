import 'package:flutter/material.dart';

import 'puzzle_game_page.dart';

class PuzzlePage extends StatelessWidget {
  const PuzzlePage({super.key});

  @override
  Widget build(BuildContext context) {
    return const PuzzleGamePage(
      tileFolder: 'assets/challenge/nasiGoreng',
      hintImagePath: 'assets/foods/nasi_goreng.png',
    );
  }
}
