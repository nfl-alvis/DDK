import 'package:flutter/material.dart';

import '../puzzle/puzzle_game_page.dart';

class PuzzleGudegPage extends StatelessWidget {
  const PuzzleGudegPage({super.key});

  @override
  Widget build(BuildContext context) {
    return const PuzzleGamePage(
      tileFolder: 'assets/challenge/gudeg',
      hintImagePath: 'assets/foods/Gudeg.png',
    );
  }
}
